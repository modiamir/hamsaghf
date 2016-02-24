<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Image;
use AppBundle\Entity\Media;
use AppBundle\Entity\Video;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    /**
     * @Route("/upload/{media}", name="upload_media", defaults={"media"=null})
     * @Method({"POST", "GET"})
     * @Template(template="default/uploadFile.html.twig")
     */
    public function uploadFileAction(Media $media = null, Request $request)
    {
        if (!$media) {
            $media = new Image();
        }

        $form = $this->createFormBuilder($media)
            ->add('name')
            ->add('file')
            ->add('submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($media);
            $em->flush();

            return $this->redirectToRoute('upload_media');
        }

        return array('form' => $form->createView());

    }
}
