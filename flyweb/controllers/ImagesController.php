<?php

namespace controllers;

class ImagesController extends BaseController {

    const systemBasePath = '/var/www/html/';
    const uploadDir = 'uploads/';
    const basePath = self::systemBasePath . self::uploadDir;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Saves into files all uploaded files into self::basePath
     * a list of saved fileIds is returned
     *
     * @return array
     */
    public function saveAllUploadedImages(): array {
        $fileIds = [];
        foreach($_FILES as $fieldName => $file) {
            $fileIds[$fieldName] = $this->saveUploadedImage($file);
        }

        return $fileIds; 
    }

    /**
     * Save file described in $file_info into self::basePath
     * If file is correctly saved a unique imageId is returned, an empty string is returned otherwise
     *
     * @param array $file_info
     * @return string
     */
    public function saveUploadedImage(array $file_info): string {
        $imageId = uniqid() . '_' . $file_info['name'];
        
        $moved = move_uploaded_file($file_info['tmp_name'], self::basePath . $imageId);

        if (!$moved) {
            return '';
        } else {
            return $imageId;
        }
    }

    /**
     * Returns the path of the image
     *
     * @param string $imageId
     * @return string
     */
    public function getImagePath(string $imageId): string {
        return '/' . self::uploadDir . $imageId ;
    }

    /**
     * Returns the image name
     *
     * @param string $imageId
     * @return string
     */
    public function getImageName(string $imageId): string {
        return substr($imageId, 14);
    }
}