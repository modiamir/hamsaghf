<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Image;
use AppBundle\Entity\Video;

/**
 * Class MediaFactory
 * @package AppBundle\Factory
 */
class MediaFactory
{
    /**
     * @param $context
     *
     * @return Image|Video
     *
     * @throws \Exception
     */
    public function build($context)
    {
        switch ($context) {
            case 'image':
                return new Image();
                break;
            case 'video':
                return new Video();
                break;
            default:
                throw new \Exception('Context is not valid');
                break;
        }
    }
}