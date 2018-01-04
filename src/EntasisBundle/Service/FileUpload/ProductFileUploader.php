<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 03.01.18
 * Time: 11:28
 */

namespace EntasisBundle\Service\FileUpload;


use EntasisBundle\Service\ImageManager\ImageResize;

class ProductFileUploader extends AbstractFileUploader
{
    private $width;
    private $height;

    public function __construct($targetDirPath, $targetDirName, $width, $height)
    {
        parent::__construct($targetDirPath, $targetDirName);
        $this->width = $width;
        $this->height = $height;
    }

    public function resizeImage($filePath)
    {
        $imageResize = new ImageResize($filePath);
        $imageResize
            ->resizeImage($this->width, $this->height)
            ->save($filePath);
    }
}