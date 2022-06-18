<?php

require 'vendor/autoload.php';

use App\Tree;
use App\Node;
use App\Enum\TreeFieldsEnum;
use App\Render\Csv\TreeRender;

$treeRender = new TreeRender();
$tableTree = $treeRender->read('input.csv');

$treeInstance = new Tree();
foreach ($tableTree as $row) {
    $treeInstance->addNode(new Node($row[TreeFieldsEnum::ITEM_NAME], $row[TreeFieldsEnum::PARENT], $row[TreeFieldsEnum::RELATION]));
}
$tree = $treeInstance->generate();

$treeRender->saveJson('output.json', $tree);
