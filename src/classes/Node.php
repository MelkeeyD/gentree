<?php


namespace App;

use Exception;

class Node
{
    protected $name = null;
    protected $parent = null;
    protected $relation = null;

    /**
     * Node constructor.
     * @param string $name
     * @param string|null $parent
     * @param string|null $relation
     * @throws Exception
     */
    public function __construct(string $name, ?string $parent, ?string $relation)
    {
        if (!$name) {
            throw new Exception('name is required');
        }

        $this->name = $name;
        $this->parent = $parent;
        $this->relation = $relation;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getParent(): ?string
    {
        return $this->parent;
    }

    /**
     * @return string|null
     */
    public function getRelation(): ?string
    {
        return $this->relation;
    }
}