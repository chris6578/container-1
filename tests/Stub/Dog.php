<?php

namespace Tests\Stub;

class Dog implements AnimalInterface
{
    /**
     * @var Bar
     */
    private $bar;

    public function __construct(FooInterface $bar)
    {
        $this->bar = $bar;
    }
}
