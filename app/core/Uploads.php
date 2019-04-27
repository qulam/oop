<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24/03/2019
 * Time: 10:27 PM
 */

namespace app\core;

class Uploads
{
    public $fileDestination;

    public function __construct()
    {
        // some codes ..
    }




    /**
     * @param $file
     * @param $options
     * @return bool
     * $options is array ['maxSize', 'minSize', 'allow', 'destination']
     */
    public function filePrepare($file, $options)
    {
        // file attr
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        if(in_array($fileActualExt, $options['allow'])){
            if($fileError === 0){
                if($fileSize > $options['minSize'] && $fileSize < $options['maxSize']){
                    $fileNewName = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = $options['destination'] . $fileNewName;
                    $this->fileDestination = $fileDestination;

                    move_uploaded_file($fileTmpName, $fileDestination);

                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
           return false;
        }
    }




    /**
     * @return mixed
     */
    public function getFileDestination()
    {
        return $this->fileDestination;
    }

}