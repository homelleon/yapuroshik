<?php

namespace AppBundle\Service\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use AppBundle\Entity\File\Image;
use AppBundle\Entity\File\Avatar;

/*
 * Configure files.
 * 
 * @author homelleon
 */

class FileConfigurator {

    /**
     * @param UploadedFile $file
     * @param string $directory
     * @param class $entityClass
     * @return Image
     */
    public function getImage($file, $directory, $entityClass) {
        $format = $file->guessExtension();
        $fileName = md5(uniqid()) . '.' . $format;
        $file->move(
                $directory, $fileName
        );
        $image = new $entityClass($fileName);
        $image->setName($fileName);
        $image->setFormat($format);
        
        return $image;
    }

}
