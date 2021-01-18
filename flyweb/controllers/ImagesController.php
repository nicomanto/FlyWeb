<?php

namespace controllers;

class ImagesController extends BaseController {

    private $systemBasePath;
    private $uploadDir;
    private $basePath;

    public function __construct() {
        parent::__construct();
        $this->systemBasePath = $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/';
        $this->uploadDir = 'uploads/';
        $this->basePath = $this->systemBasePath . $this->uploadDir;
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
        
        $moved = move_uploaded_file($file_info['tmp_name'], $this->basePath . $imageId);

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
        return './' . $this->uploadDir . $imageId ;
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