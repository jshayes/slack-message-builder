<?php

namespace Tests\Unit;

use Mockery;
use PHPUnit_Framework_TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

abstract class TestCase extends PHPUnit_Framework_TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * Sets up our test suite to not allow the mocking of methods that do not
     * exist on the mocked objects. This forces you to adhere to the interface
     * or implied interface of the mocked object.
     */
    public function setUp()
    {
        parent::setUp();

        Mockery::getConfiguration()->allowMockingNonExistentMethods(false);
        Mockery::getConfiguration()->allowMockingMethodsUnnecessarily(false);
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}
