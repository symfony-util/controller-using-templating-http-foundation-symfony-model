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
use Symfony\Component\Templating\TemplateNameParser;
use SymfonyUtil\Component\HttpFoundation\NullStringControllerModel;
use SymfonyUtil\Component\TemplatingHttpFoundation\ShowController;

/**
 * @covers \SymfonyUtil\Component\TemplatingHttpFoundation\ShowController
 */
final class ShowControllerTest extends TestCase
{
    public function testCanBeCreated()
    {
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\TemplatingHttpFoundation\ShowController',
            new ShowController(new NullStringControllerModel(), new TwigEngine(
                new Twig_Environment(new Twig_Loader_Array(['show.html.twig' => 'Hello World!'])),
                new TemplateNameParser()
            ))
        );
    }

    public function testReturnsResponse()
    {
        $controller = new ShowController(new NullStringControllerModel(), new TwigEngine(
            new Twig_Environment(new Twig_Loader_Array(['show.html.twig' => 'Hello World!'])),
            new TemplateNameParser()
        ));
        $this->assertInstanceOf(
            // Response::class, // 5.4 < php
            'Symfony\Component\HttpFoundation\Response',
            $controller('')
        );
    }
}
