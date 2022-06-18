<?php

namespace App;

class Tree
{
    protected $nodes = [];
    protected $parents = [];
    protected $tree = [];

    /**
     * @param Node $node
     * @return void
     */
    public function addNode(Node $node): void
    {
        $this->nodes[$node->getName()] = $node;
    }

    /**
     * @return array
     */
    public function generate(): array
    {
        $this->generateParents();

        $tree = reset($this->parents);
        $this->generateTree($tree);
        $this->tree = $tree;

        return $tree;
    }

    /**
     * @param $tree
     * @param null $parent
     */
    protected function generateTree(&$tree, $parent = null): void
    {
        foreach ($tree as &$node) {
            if (!isset($this->parents[$node['itemName']])) {
                continue;
            }
            $node['children'] = $this->parents[$node['itemName']] ?: [];
            $node['parent'] = $parent;

            $this->generateTree($node['children'], $node['itemName']);
        }
    }

    protected function generateParents(): void
    {
        $relations = [];
        foreach ($this->nodes as $node) {
            if ($relation = $node->getRelation()) {
                $relations[$node->getName()] = $relation;
            }
            $this->parents[$node->getParent()][] = [
                'itemName' => $node->getName(),
                'parent' => $node->getParent(),
                'children' => []
            ];
        }
        foreach ($relations as $name => $relation) {
            $this->parents[$name] = array_merge($this->parents[$name] ?: [], $this->parents[$relation] ?: []);
        }
    }
}