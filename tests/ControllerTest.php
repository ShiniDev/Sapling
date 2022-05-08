<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Sapling\Controller\Controller;

final class ControllerTest extends TestCase
{
    public function testLoadView(): void
    {
        $this->setOutputCallback(function () {
        });
        $controller = new Controller();
        $this->assertSame(true, $controller->loadView('index'));
    }

    public function testFailedToLoadView(): void
    {
        $this->setOutputCallback(function () {
        });
        $controller = new Controller();
        $this->assertSame(false, $controller->loadView(''));
    }

    public function testLoadModel(): void
    {
        $this->setOutputCallback(function () {
        });
        $controller = new Controller();
        $this->assertSame(true, $controller->loadModel('TestModel'));
    }

    public function testFailedToLoadModel(): void
    {
        $this->setOutputCallback(function () {
        });
        $controller = new Controller();
        $this->assertSame(false, $controller->loadModel(''));
    }
}
