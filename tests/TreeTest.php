<?php

use App\Node;
use PHPUnit\Framework\TestCase;
use App\Tree;

class TreeTest extends TestCase
{
    public function testGenerate()
    {
        $data = [
            ['1', null, ''],
            ['2', '1'],
            ['3', '1'],
            ['4', '3'],
            ['5', '4'],
            ['6', '2', '3']
        ];

        $tree = new Tree();
        foreach ($data as $item) {
            $tree->addNode(new Node($item[0], $item[1], $item[2]));
        }

        $actual = [
            [
                'itemName' => '1',
                'parent' => null,
                'children' => [
                    [
                        'itemName' => '2',
                        'parent' => '1',
                        'children' => [
                            [
                                'itemName' => '6',
                                'parent' => '2',
                                'children' => [
                                    [
                                        'itemName' => '4',
                                        'parent' => '6',
                                        'children' => [
                                            [
                                                'itemName' => '5',
                                                'parent' => '4',
                                                'children' => []
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        'itemName' => '3',
                        'parent' => '1',
                        'children' => [
                            [
                                'itemName' => '4',
                                'parent' => '3',
                                'children' => [
                                    [
                                        'itemName' => '5',
                                        'parent' => '4',
                                        'children' => []
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $this->assertSame(
            json_encode($actual),
            json_encode($tree->generate())
        );
    }
}