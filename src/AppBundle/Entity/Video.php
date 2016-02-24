<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VideoRepository")
 */
class Video extends Media
{
    /**
     * @Assert\File(
     *     mimeTypes = {"video/mpeg", "video/mp4"}
     * )
     */
    protected $file;

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/video in the view.
        return 'uploads/videos';
    }
}
