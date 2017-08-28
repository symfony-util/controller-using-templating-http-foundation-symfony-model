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
use SymfonyUtil\Component\HttpFoundation\NullControllerModel;
use SymfonyUtil\Component\TemplatingHttpFoundation\IndexController;

/**
 * @covers \SymfonyUtil\Component\TemplatingHttpFoundation\IndexController
 */
final class IndexControllerTest extends TestCase
{
    public function testCanBeCreated()
    {
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\TemplatingHttpFoundation\IndexController',
            new IndexController(new NullControllerModel(), new TwigEngine(
                new Twig_Environment(new Twig_Loader_Array(['index.html.twig' => 'Hello World!'])),
                new TemplateNameParser()
            ))
        );
    }

    public function testReturnsResponse()
    {
        $controller = new IndexController(new NullControllerModel(), new TwigEngine(
            new Twig_Environment(new Twig_Loader_Array(['index.html.twig' => 'Hello World!'])),
            new TemplateNameParser()
        ));
        $this->assertInstanceOf(
            // Response::class, // 5.4 < php
            'Symfony\Component\HttpFoundation\Response',
            $controller()
        );
    }
}
