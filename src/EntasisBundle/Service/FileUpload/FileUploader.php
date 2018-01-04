<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20.12.17
 * Time: 10:34
 */

namespace EntasisBundle\Service\FileUpload;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileUploader
{
    public function upload(UploadedFile $file);
    public function multiUpload(array $files);
}