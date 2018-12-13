<?php

namespace App\Entity;

/**
 * Class AbstractEntity
 *
 * @package App\Entity
 */
abstract class AbstractEntity
{
    /** @var int */
    protected $id = 0;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }
}
