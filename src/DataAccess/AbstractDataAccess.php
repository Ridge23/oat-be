<?php

namespace App\DataAccess;

use App\Entity\AbstractEntity;
use App\Exception\UserNotFoundException;

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
     * @param int $id
     *
     * @return AbstractEntity
     *
     * @throws UserNotFoundException
     */
    public function getEntityById($id)
    {
        $fileContent = $this->getFileContent();
        $entities = $this->serializeContent($fileContent);

        /** @var AbstractEntity $entity */
        foreach ($entities as $entity) {
            if ($entity->getId() === (int)$id) {
                return $entity;
            }
        }

        throw new UserNotFoundException();
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
