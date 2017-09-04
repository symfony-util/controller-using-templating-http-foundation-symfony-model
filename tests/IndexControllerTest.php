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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollectionBuilder;
use Symfony\Component\Templating\TemplateNameParser;
use SymfonyUtil\Component\HttpFoundation\NullControllerModel;
use SymfonyUtil\Component\HttpFoundationPOInterface\ControllerModel;
use SymfonyUtil\Component\HttpFoundationPOInterface\NullActionModel;
use SymfonyUtil\Component\HttpFoundationPOInterface\NullViewModel;
use SymfonyUtil\Component\RoutingHttpFoundation\Generator\RedirectToRoute;
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

    public function testRedirectResponseReturnsUrl()
    {
        $example = 'http://example.org/';
        $controller = new IndexController(new NullControllerModel(new RedirectResponse($example)), new TwigEngine(
            new Twig_Environment(new Twig_Loader_Array(['index.html.twig' => 'Hello World!'])),
            new TemplateNameParser()
        ));
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\TemplatingHttpFoundation\IndexController',
            $controller
        );
        $response = $controller();
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'Symfony\Component\HttpFoundation\Response',
            $response
        );
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'Symfony\Component\HttpFoundation\RedirectResponse',
            $response
        );
        $url = $response->getTargetUrl();
        $this->assertInternalType('string', $url);
        $this->assertSame($example, $url);
    }

    public function testRouteRedirectResponseReturnsUrl()
    {
        $example = '/example';
        $controller = new IndexController(
            new NullControllerModel(
                new RedirectResponse(
                    (new UrlGenerator(
                        (new RouteCollectionBuilder())->addRoute(new Route($example), 'index')->build(),
                        new RequestContext()
                    ))->generate('index')
                )
            ),
            new TwigEngine(
                new Twig_Environment(new Twig_Loader_Array(['index.html.twig' => 'Hello World!'])),
                new TemplateNameParser()
            )
        );
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\TemplatingHttpFoundation\IndexController',
            $controller
        );
        $response = $controller();
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'Symfony\Component\HttpFoundation\Response',
            $response
        );
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'Symfony\Component\HttpFoundation\RedirectResponse',
            $response
        );
        $url = $response->getTargetUrl();
        $this->assertInternalType('string', $url);
        $this->assertSame($example, $url);
    }

    public function testRouteRedirectResponseReturnsUrlWithRedirectToRoute()
    {
        $example = '/example';
        $controller = new IndexController(
            new NullControllerModel(
                (new RedirectToRoute(
                    new UrlGenerator(
                        (new RouteCollectionBuilder())->addRoute(new Route($example), 'index')->build(),
                        new RequestContext()
                    )
                ))->__invoke('index')
            ),
            new TwigEngine(
                new Twig_Environment(new Twig_Loader_Array(['index.html.twig' => 'Hello World!'])),
                new TemplateNameParser()
            )
        );
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\TemplatingHttpFoundation\IndexController',
            $controller
        );
        $response = $controller();
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'Symfony\Component\HttpFoundation\Response',
            $response
        );
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'Symfony\Component\HttpFoundation\RedirectResponse',
            $response
        );
        $url = $response->getTargetUrl();
        $this->assertInternalType('string', $url);
        $this->assertSame($example, $url);
    }

    public function testCanBeCreatedWithControllerModel()
    {
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\TemplatingHttpFoundation\IndexController',
            new IndexController(new ControllerModel(new NullActionModel(), new NullViewModel()), new TwigEngine(
                new Twig_Environment(new Twig_Loader_Array(['index.html.twig' => 'Hello World!'])),
                new TemplateNameParser()
            ))
        );
    }

    public function testReturnsResponseWithControllerModel()
    {
        $controller = new IndexController(new ControllerModel(new NullActionModel(), new NullViewModel()), new TwigEngine(
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
