<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 03.01.18
 * Time: 12:34
 */

namespace EntasisBundle\Service\ImageManager;


class ImageResize
{
    const QUALITY = 100;
    const TARGET_DIR = __DIR__.'/../../../../web';

    private $filePath;
    private $image;
    private $resultImage;
    private $image_w;
    private $image_h;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->image = $this->createImage($this->filePath);
        $this->image_w = imagesx($this->image);
        $this->image_h = imagesy($this->image);
    }

    private function createImage($filePath)
    {
        $format = substr($filePath, -3);
        switch ($format) {
            case 'jpg' || 'jpeg':
                return imagecreatefromjpeg(self::TARGET_DIR.$filePath); break;
            case 'png':
                return imagecreatefrompng(self::TARGET_DIR.$filePath); break;
            case 'gif':
                return imagecreatefromgif(self::TARGET_DIR.$filePath); break;
        }
    }

    public function resizeImage($width, $height)
    {
        $this->resultImage = imagecreatetruecolor($width, $height);

        imagecopyresized($this->resultImage, $this->image, 0, 0, 0, 0,
            $width, $height, $this->image_w, $this->image_h);

        return $this;
    }

    public function save($path)
    {
        try {
            imagejpeg($this->resultImage, self::TARGET_DIR.$path, self::QUALITY);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}