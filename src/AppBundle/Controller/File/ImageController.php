<?php

namespace AppBundle\Controller\File;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\File\Image;

/**
 * Images controller.
 */
class ImageController extends Controller
{
    /**
     * Renders page with image with setted id parameter.
     * 
     * @Route("/image/{id}")
     */
    public function showAction($id)
    {
        $doctrine = $this->getDoctrine();
        $image = $doctrine
            ->getRepository(Image::class)
            ->find($id);
        
        return $this->render(':File/Image:index.html.twig',[
            'image' => $image
        ]);
    }
    
}
