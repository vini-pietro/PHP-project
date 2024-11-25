<?php

use PHPUnit\Framework\TestCase;
use Viniciuspietro\Task2\Resource;

class ResourceTest extends TestCase {
    protected function setUp(): void {
        // Resets the ID counter before each test
        Resource::setNextId(1);
    }

    public function testResourceCreation() {
        $resource = new Resource("Test Resource", 10);
        $this->assertEquals("Test Resource", $resource->getType());
        $this->assertEquals(10, $resource->getQuantity());
    }

    public function testResourceDetails() {
        $resource = new Resource("Test Resource", 10);
        $expectedDetails = "Resource ID: 1, Type: Test Resource, Quantity: 10";
        $this->assertEquals($expectedDetails, $resource->getResourceDetails());
    }
}
