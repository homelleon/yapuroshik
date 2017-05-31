<?php

namespace AppBundle\Controller\File;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\File\Image;

class ImageController extends Controller
{
    /**
     * @Route("/image/{id}")
     */
    public function imageAction($id)
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
