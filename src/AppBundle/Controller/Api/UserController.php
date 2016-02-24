<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\PhoneVerificationCode;
use AppBundle\Entity\User;
use AppBundle\Form\UserPhoneVerify;
use AppBundle\Form\UserPhoneVerifyType;
use PhpOption\Tests\Repository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package AppBundle\Controller\Api
 * @Route(path="/api")
 */
class UserController extends Controller
{
    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(path="/test")
     */
    public function indexAction()
    {

        if($this->getUser() instanceof User) {
            return new JsonResponse([$this->getUser()->getId()]);
        } else {
            return new JsonResponse(['none']);
        }
    }

    /**
     * @param Request $request
     * @Route(path="/login")
     * @Method({"POST", "GET"})
     */
    public function loginAction(Request $request) {
        $userRequest = json_decode($request->getContent());

        $user = $this->getDoctrine()->getRepository('AppBundle:User')
            ->findOneBy(['email' => $userRequest->email]);

        if ($user instanceof User) {
            $isValid = $this->get('security.password_encoder')->isPasswordValid($user, $userRequest->password);
            if ($isValid) {
                $this->getDoctrine()->getRepository('User')->generateApiKey($user, $this->get('service_container'));
                return new JsonResponse(['token' => $user->getApiKey()]);
            } else {

                return new Response('', 500);
            }
        }

        return new Response('', 500);
    }

    /**
     * @param Request $request
     * @Route(path="/login/phone")
     * @Method({"POST"})
     */
    public function phoneLoginAction(Request $request)
    {
        $phone = $request->get('phone');

        if (!$phone) {
            return new Response('Phone required', Response::HTTP_BAD_REQUEST);
        }

        if (!preg_match("/^[0-9]{11}$/", $phone)) {
            return new Response('Phone is invalid', Response::HTTP_BAD_REQUEST);
        }

        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(['phone' => $phone]);
        if (!$user instanceof User) {
            $user = new User();
            $user->setPhone($phone);
        }
        $code = $this->createVerificationCode($user);

        return new JsonResponse(['code' => $code]);
    }

    /**
     * @Route(path="/login/phone/verify", defaults={"_format"="json"})
     * @Method({"POST"})
     */
    public function verifyPhone(Request $request)
    {
        $form = $this->createForm(new UserPhoneVerifyType($this->get('service_container')));

        $form->submit($request);

        if ($form->isValid()) {
            $user = $this->getDoctrine()
                ->getRepository('AppBundle:User')
                ->findOneBy([
                    'phone' => $form->getData()['phone']
                ]);
            $phoneVerifications = $this->getDoctrine()
                ->getRepository('AppBundle:PhoneVerificationCode')
                ->findOneBy([
                    'code' => $form->getData()['code'],
                    'user' => $user
                ]);

            if ($phoneVerifications instanceof PhoneVerificationCode) {
                $this->getDoctrine()
                    ->getRepository('AppBundle:User')
                    ->generateApiKey($user, $this->get('service_container'));

                return new JsonResponse(['token' => $user->getApiKey()]);
            }

        }

        return new Response($this->get('jms_serializer')->serialize($form->getErrors(), 'json'));
    }

    private function createVerificationCode(User $user)
    {
        $phoneVerificationCode = new PhoneVerificationCode();
        $phoneVerificationCode->setUser($user);
        $phoneVerificationCode->setCode(rand(100000, 999999));
        $em = $this->getDoctrine()->getManager();
        $em->persist($phoneVerificationCode);
        $em->flush();

        return $phoneVerificationCode->getCode();
    }
}
