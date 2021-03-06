<?php

namespace Tests;

use Gravatalonga\Container\Container;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class ContainerArrayAccessTest extends TestCase
{
    /**
     * @test
     */
    public function can_use_offset_set()
    {
        $container = new Container();
        $container['fact'] = function (ContainerInterface $container) {
            return rand(0, 100);
        };

        $this->assertTrue($container->has('fact'));
        $this->assertNotEmpty($container->get('fact'));
        $this->assertGreaterThanOrEqual(0, $container->get('fact'));
        $this->assertNotSame($container->get('fact'), $container->get('fact'));
    }

    /**
     * @test
     */
    public function can_use_offset_get()
    {
        $container = new Container();
        $container['fact'] = function (ContainerInterface $container) {
            return rand(1, 100);
        };

        $this->assertGreaterThanOrEqual(1, $container['fact']);
    }

    /**
     * @test
     */
    public function can_use_offset_exists()
    {
        $container = new Container();
        $container['fact'] = function (ContainerInterface $container) {
            return rand(1, 100);
        };

        $this->assertTrue(isset($container['fact']), "cannot find entry using 'isset'");
        $this->assertFalse(empty($container['fact']), "cannot find entry using 'empty'");
    }

    /**
     * @test
     */
    public function can_use_offset_unset()
    {
        $container = new Container();
        $container->share('hello', function () {
            return 'world';
        });
        $container->set('my', function (ContainerInterface $container) {
            return 'you';
        });
        $container->set('my-constant', '123');

        unset($container['hello']);
        unset($container['my']);
        unset($container['my-constant']);

        $this->assertFalse($container->has('hello'));
        $this->assertFalse($container->has('my'));
        $this->assertFalse($container->has('my-constant'));
    }
}
