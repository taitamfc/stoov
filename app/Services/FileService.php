<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    private $storage;

    /**
     * constructor.
     *
     * @param Storage $storage
     */
    public function __construct(Storage $storage)
    {
        $this->storage = Storage::disk('local');
    }

    /**
     * Upload file.
     *
     * @param $folder
     * @param $file
     * @return string
     */
    public function uploadFile($folder, $file)
    {
        $originalName = $file->getClientOriginalName();

        $nameFile = $originalName;
        $filePath = $folder . '/' . $nameFile;
        if ($this->storage->exists($filePath)) {
            $i = 1;
            while ($this->storage->exists($filePath)) {
                $nameFile = $i . '_' . $originalName;
                $filePath = $folder . '/' . $nameFile;
                $i++;
            }
        }

        if (!$this->storage->exists($folder)) {
            $path = $this->storage->getDriver()->getAdapter()->getPathPrefix();
            mkdir("{$path}{$folder}");
        }

        $this->storage->putFileAs($folder, $file, $nameFile);

        return $filePath;
    }
}
