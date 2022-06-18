<?php


namespace App\Render;

use Exception;

abstract class AbstractTreeRender
{
    abstract public function read(string $path);

    /**
     * @param array $tree
     * @param string $path
     * @return bool
     * @throws Exception
     */
    public function saveJson(string $path, array $tree): bool
    {
        if (!file_put_contents($path, json_encode($tree, JSON_UNESCAPED_UNICODE))) {
            throw new \Exception('path ' . $path . ' is not found');
        }
        return true;
    }
}