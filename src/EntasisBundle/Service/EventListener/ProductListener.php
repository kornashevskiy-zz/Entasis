<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 03.01.18
 * Time: 11:23
 */

namespace EntasisBundle\Service\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use EntasisBundle\Entity\Product;
use EntasisBundle\Service\FileUpload\ProductFileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductListener
{
    private $uploader;
    const UPLOAD_DIR = __DIR__.'/../../../../web';

    public function __construct(ProductFileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Product) {
            return;
        }

        if ($entity->getTitleImage() instanceof UploadedFile) {
            $filename = $this->uploadFile($entity->getTitleImage());
            $this->uploader->resizeImage($filename);
            $entity->setTitleImage($filename);
            $entity->setCreateAt(new \DateTime('now', new \DateTimeZone('Europe/Moscow')));
        }

        if (is_array($entity->getImages())) {
            $fileNames = $this->uploadMultiFiles($entity->getImages());
            $entity->setImages($fileNames);
        }

    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Product) {
            return;
        }

        if ($entity->getTitleImage() != null && $entity->getTitleImage() instanceof UploadedFile) {
            $pathForRemove = sprintf('%s%s', self::UPLOAD_DIR, $entity->getHiddenImage());

            unlink($pathForRemove);

            $filename = $this->uploadFile($entity->getTitleImage());
            $this->uploader->resizeImage($filename);
            $entity->setTitleImage($filename);
        } else {
            $entity->setTitleImage($entity->getHiddenImage());
        }

        if (!empty($entity->getImages())) {

            foreach (json_decode($entity->getHiddenImages()) as $image) {
                $pathForRemove = sprintf('%s%s', self::UPLOAD_DIR, $image);
                unlink($pathForRemove);
            }

            $fileNames = $this->uploadMultiFiles($entity->getImages());
            $entity->setImages($fileNames);
        } else {
            $entity->setImages($entity->getHiddenImages());
        }

    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Product) {
            return;
        }

        if ($entity->getTitleImage() != null) {
            $pathForRemove = sprintf('%s%s', self::UPLOAD_DIR, $entity->getTitleImage());

            unlink($pathForRemove);
        }

        if (!empty($entity->getImages())) {
            foreach (json_decode($entity->getImages()) as $image) {
                $pathForRemove = sprintf('%s%s', self::UPLOAD_DIR, $image);
                unlink($pathForRemove);
            }
        }
    }

    private function uploadFile(UploadedFile $file)
    {
        return $this->uploader->upload($file);
    }

    public function uploadMultiFiles(array $files)
    {
        return $this->uploader->multiUpload($files);
    }

}