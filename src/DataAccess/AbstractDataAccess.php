<?php

namespace App\DataAccess;

/**
 * Class AbstractDataAccess
 *
 * @package App\DataAccess
 */
abstract class AbstractDataAccess
{
    /** @var string */
    protected $dataFolder = '';

    /** @var string */
    protected $fileName = '';

    /** @var string */
    private $filePath = '';

    /**
     * AbstractDataAccess constructor.
     */
    public function __construct()
    {
        $this->dataFolder = $_SERVER['DOCUMENT_ROOT'] . '/../data/';
        $this->filePath = $this->dataFolder . $this->fileName;
    }

    /**
     * @return array
     */
    public function getEntities()
    {
        $fileContent = $this->getFileContent();
        $entities = $this->serializeContent($fileContent);

        return $entities;
    }

    /**
     * @return string
     */
    private function getFileContent()
    {
        return file_get_contents($this->filePath) ?? '';
    }

    /**
     * @param string $content
     *
     * @return array
     */
    abstract function serializeContent($content);
}
