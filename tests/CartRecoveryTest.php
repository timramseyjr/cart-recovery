<?php

namespace timramseyjr\CartRecovery\Tests;

use timramseyjr\CartRecovery\Facades\CartRecovery;
use timramseyjr\CartRecovery\ServiceProvider;
use Orchestra\Testbench\TestCase;

class CartRecoveryTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'cart-recovery' => CartRecovery::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}
