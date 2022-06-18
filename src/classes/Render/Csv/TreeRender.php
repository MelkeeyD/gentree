<?php


namespace App\Render\Csv;


use App\Render\AbstractTreeRender;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\ResultSet;
use League\Csv\Statement;

class TreeRender extends AbstractTreeRender
{
    protected $limit = 20000;

    /**
     * @param string $path
     * @return ResultSet
     * @throws Exception
     */
    public function read(string $path): ResultSet
    {
        $csv = Reader::createFromPath($path);

        $csv->setDelimiter(';');
        $csv->setHeaderOffset(0);

        $stmt = (new Statement())
            ->limit($this->limit);

        return $stmt->process($csv);
    }
}