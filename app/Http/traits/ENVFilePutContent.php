<?php
namespace App\Http\traits;

trait ENVFilePutContent{

    public function dataWriteInENVFile($key,$value)
    {
        $path = '.env';
        $searchArray = array($key.'='.env($key));
        $replaceArray= array($key.'='.$value);
        if (!file_exists($path)) {
            $path = '../.env';
        }
        file_put_contents($path, str_replace($searchArray, $replaceArray, file_get_contents($path)));
    }

}
