<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use AppBundle\Entity\File\Image;
use AppBundle\Entity\File\Avatar;

/*
 * Configure files.
 */

class FileConfigurator {

    /**
     * @param UploadedFile $file
     * @param string $directory
     * @return Image
     */
    public function getImage($file, $directory) {
        $format = $file->guessExtension();
        $fileName = $this->moveFile($file, $format, $directory);

        $image = new Image($fileName);
        $image->setName($fileName);
        $image->setFormat($format);

        return $image;
    }

    /**
     * @param UploadedFile $file
     * @param string $directory
     * @return Avatar
     */
    public function getAvatar($file, $directory) {
        $format = $file->guessExtension();
        $fileName = $this->moveFile($file, $format, $directory);

        $avatar = new Avatar($fileName);
        $avatar->setName($fileName);
        $avatar->setFormat($format);

        return $avatar;
    }

    private function moveFile($file, $format, $directory) {
        $fileName = md5(uniqid()) . '.' . $format;
        $file->move(
                $directory, $fileName
        );
        return $fileName;
    }

}
