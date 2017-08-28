<?php

/*
 * This file is part of the Symfony-Util package.
 *
 * (c) Jean-Bernard Addor
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\TestCase;
use Symfony\Bridge\Twig\TwigEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Templating\TemplateNameParser;
use SymfonyUtil\Component\HttpFoundation\IndexController;
use SymfonyUtil\Component\HttpFoundation\NullControllerModel;

/**
 * @covers \SymfonyUtil\Component\HttpFoundation\IndexController
 */
final class IndexControllerTest extends TestCase
{
    public function testCanBeCreated()
    {
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\HttpFoundation\IndexController',
            new IndexController(new NullControllerModel(), new TwigEngine(
                new Twig_Environment(new Twig_Loader_Array(['index.html.twig' => 'Hello World!'])),
                new TemplateNameParser()
            ))
        );
    }

    public function testReturnsArray()
    {
        $controller = new IndexController(new NullControllerModel(), new TwigEngine(
            new Twig_Environment(new Twig_Loader_Array(['index.html.twig' => 'Hello World!'])),
            new TemplateNameParser()
        ));
        $this->assertInternalType('array', $controller->__invoke(new Request()));
        $this->assertSame([], $controller->__invoke(new Request()));
        $this->assertSame(0, count($controller->__invoke(new Request())));
        $this->assertEmpty((new NullControllerModel())->__invoke(new Request()));
    }
}
