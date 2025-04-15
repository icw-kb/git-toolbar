<?php
namespace Test\Collector;

use icwkb\GitToolbar\Collector\GitCollector;
use PHPUnit\Framework\TestCase;;

class GitCollectorTest extends TestCase
{
    public function testGetName()
    {
        $collector = new GitCollector();
        $name = $collector->getName();

        $this->assertSame('git.toolbar', $name);
    }

    public function testGetPriority()
    {
        $collector = new GitCollector();
        $priority = $collector->getPriority();

        $this->assertSame(15, $priority);
    }
}