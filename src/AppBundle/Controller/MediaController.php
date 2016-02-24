<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Media;
use AppBundle\Form\MediaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Uploadable\Fixture\Entity\Image;

class MediaController extends Controller
{
    /**
     * @Route(
     *     "/media/upload/{context}",
     *     requirements={"context"="image|video"},
     *     name="media_upload",
     *     defaults={"_format"="json"}
     *     )
     */
    public function uploadAction(Request $request, $context)
    {
        try {
            $media = $this->get('app.media.factory')->build($context);

            $file = $request->files->get('files')[0];

            $media->setFile($file);

            $errors = $this->get('validator')->validate($media);

            if (count($errors) == 0) {

                $em = $this->getDoctrine()->getManager();

                $em->persist($media);
                $em->flush();

                $result = [
                    'files' => [$media]
                ];

                return new Response($this->get('jms_serializer')->serialize($result, 'json'));
            }

            $errorText = "";

            foreach ($errors as $error) {
                $errorText .= $error->getMessage() . ' ';
            }

            return new Response($errorText, 500);
        } catch(\Exception $e) {

            return new Response($e->getMessage(), 500);
        }

    }

}
