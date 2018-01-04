<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20.12.17
 * Time: 10:36
 */

namespace EntasisBundle\Service\FileUpload;

use Symfony\Component\HttpFoundation\File\UploadedFile;

abstract class AbstractFileUploader implements FileUploader
{
    private $targetDirPath;
    private $targetDirName;
    const MULTI_DIR = '/multi';
    const TITLE_DIR = '/title';

    public function __construct($targetDirPath, $targetDirName)
    {
        $this->targetDirPath = $targetDirPath;
        $this->targetDirName = $targetDirName;
    }

    public function upload(UploadedFile $file)
    {
        $targetDir = sprintf('%s%s%s', __DIR__,  $this->targetDirPath, self::TITLE_DIR);

        if (!file_exists($targetDir)) {
            mkdir($targetDir);
        }

        $fileName = time().$file->getClientOriginalName();

        $file->move($targetDir, $fileName);

        return $this->getFileNameForDb(
            sprintf('%s/%s', $targetDir, $fileName)
        );
    }

    public function multiUpload(array $files)
    {
        $fileNamesForDb = [];
                            /** @var UploadedFile $file */
        foreach ($files as $file) {

            $targetDir = sprintf('%s%s%s', __DIR__, $this->targetDirPath,  self::MULTI_DIR);

            if (!file_exists($targetDir)) {
                mkdir($targetDir);
            }

            $fileName = sprintf('%s%s', time(), $file->getClientOriginalName());

            $file->move($targetDir, $fileName);

            $fileNamesForDb[] =  $this->getFileNameForDb(
                sprintf('%s/%s', $targetDir, $fileName)
            );
        }

        return json_encode($fileNamesForDb);
    }

    public function getFileNameForDb($filename)
    {
        $pos = strpos($filename, $this->targetDirName);

        return substr($filename, $pos);
    }
}