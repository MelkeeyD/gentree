<?php

use PHPUnit\Framework\TestCase;
use App\Node;

class NodeTest extends TestCase
{
    public function testAdd()
    {
        $node = new Node('name', 'parent', '');
        $this->assertSame($node->getName(), 'name');
        $this->assertSame($node->getParent(), 'parent');
        $this->assertSame($node->getRelation(), '');

        $node = new Node('name', '', '');
        $this->assertSame($node->getName(), 'name');
        $this->assertSame($node->getParent(), '');
        $this->assertSame($node->getRelation(), '');

        $this->expectException(Exception::class);
        new Node('', '', '');
    }
}