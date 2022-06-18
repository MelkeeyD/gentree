<?php


namespace App;

use App\Render\Csv\TreeRender;
use Exception;
use splitbrain\phpcli\CLI;
use splitbrain\phpcli\Options;
use App\Enum\TreeFieldsEnum;


class Gentree extends CLI
{
    protected function setup(Options $options)
    {
        $options->setHelp('Generate tree in json file by csv file');
        $options->registerOption('input', 'path input csv file', 'i', 'path file');
        $options->registerOption('output', 'path output json file', 'o', 'path file');
    }

    protected function main(Options $options)
    {
        if (!$options->getOpt('input')) {
            $this->info('input was not set');
            echo $options->help();
        }

        try {
            $this->checkFile($options->getOpt('input'));

            $treeRender = new TreeRender();
            $tableTree = $treeRender->read($options->getOpt('input'));

            $treeInstance = new Tree();
            foreach ($tableTree as $row) {
                $treeInstance->addNode(new Node(
                    $row[TreeFieldsEnum::ITEM_NAME], $row[TreeFieldsEnum::PARENT], $row[TreeFieldsEnum::RELATION]));
            }

            $treeRender->saveJson($options->getOpt('output'), $treeInstance->generate());

            $this->info('Tree successfully written to file ' . $options->getOpt('output'));
        } catch (Exception $e) {
            $this->info($e->getMessage());
        }
    }

    /**
     * @param $path
     * @return bool
     * @throws Exception
     */
    protected function checkFile($path): bool
    {
        if (!file_exists($path)) {
            throw new Exception('File ' . $path . ' is not exist');
        }
        return true;
    }
}
