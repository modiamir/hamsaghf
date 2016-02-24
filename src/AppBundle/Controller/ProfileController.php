<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Householder;
use AppBundle\Entity\Housemate;
use AppBundle\Entity\Image;
use AppBundle\Entity\User;
use AppBundle\Form\HouseholderFilterType;
use AppBundle\Form\ProfileFilterType;
use AppBundle\Form\ProfileType;
use AppBundle\Entity\Profile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ProfileController extends Controller
{
    /**
     * @Route(path="profile/{context}/{profile}", name="profile_manage",
     *     requirements={"context"="householder|housemate"}
     *     )
     * @Method(methods={"GET", "POST"})
     * @Security(expression="is_granted('ROLE_USER')")
     */
    public function manageAction(Request $request, $context, Profile $profile = null)
    {
        /* @var $user User */
        $user = $this->getUser();

        if (!$profile) {
            if ($context == 'householder') {
                $otherProfile = $user->getHouseholder();
            } else {
                $otherProfile = $user->getHousemate();
            }


            if ($otherProfile) {
                throw new AccessDeniedHttpException();
            } else {
                if ($context == 'householder') {
                    $profile = new Householder();
                } else {
                    $profile = new Housemate();
                }
                $profile->setUser($user);
            }
            $edit = false;
        } else {
            if ($profile->getUser()->getId() != $user->getId()) {
                throw new AccessDeniedHttpException();
            }
            $edit = true;
        }


        $form = $this->createForm($context, $profile);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if ($profile instanceof Housemate) {
                $profile->setGuest('free');
            }
            $em->persist($profile);
            $em->flush();

            if ($edit) {
                return $this->render($context . '/new.html.twig', [
                    'form' => $form->createView(),
                    $context => $profile
                ]);
            } else {
                return $this->redirectToRoute('profile_manage', [
                    'profile' => $profile->getId(),
                    'context' => $context
                ]);
            }


        }
        return $this->render($context. '/new.html.twig', [
            'form' => $form->createView(),
            $context => $profile
        ]);
    }

    /**
     * @Route(path="profile/{context}/{profile}", name="profile_remove",
     *     defaults={"_format"="json", "context"="householder|housemate"}
     *     )
     * @Method(methods={"DELETE"})
     * @Security(expression="is_granted('ROLE_USER')")
     */
    public function deleteAction(Profile $profile)
    {
        /* @var $user User */
        $user = $this->getUser();

        if ($profile->getUser()->getId() != $user->getId()) {
            throw new AccessDeniedHttpException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($profile);
        $em->flush();
        return new JsonResponse(["success" => true]);
    }


    /**
     * @Route("profile/ads", name="profile_ads")
     * @Security(expression="is_granted('ROLE_USER')")
     * @Template(":profile:ads.html.twig")
     */
    public function adsAction()
    {
        $householders = $this->getDoctrine()
            ->getRepository('AppBundle:Householder')->findBy([
                'user' => $this->getUser()
            ]);

        $housemates = $this->getDoctrine()
            ->getRepository('AppBundle:Housemate')->findBy([
                'user' => $this->getUser()
            ]);

        return [
            'householders' => $householders,
            'housemates' => $housemates
        ];
    }

    /**
     * @Route(path="search/{context}", name="profile_search",
     *     requirements={"context"="householder|housemate"}
     *     )
     * @Method(methods={"GET", "POST"})
     */
    public function searchAction($context, Request $request)
    {

        $repo = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Profile')
            ->getFilterRepository($context);



        $form = $this->createForm(ProfileFilterType::class);

        $form->handleRequest($request);

        $qb = $repo->filterByForm($form);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $qb->getQuery(), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        // parameters to template
        return $this->render(
            ":profile:".$context."_search.html.twig",
            array(
                'pagination' => $pagination,
                'filter' => $form->createView()
            )
        );
    }
}
