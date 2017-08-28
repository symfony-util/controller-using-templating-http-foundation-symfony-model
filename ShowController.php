<?php

/*
 * This file is part of the Symfony-Util package.
 *
 * (c) Jean-Bernard Addor
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SymfonyUtil\Component\TemplatingHttpFoundation;

use SymfonyUtil\Component\HttpFoundation\ArrayShowInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

class ShowController
{
    protected $model;
    protected $templating;
    protected $template;

    public function __construct(
        ArrayShowInterface $model,
        EngineInterface $templating,
        $template = 'show.html.twig'
    )
    {
        $this->model = $model;
        $this->templating = $templating;
        $this->template = $template;
    }

    public function __invoke($id, Request $request = new Request()) // string $id since php 7.0 (Symfony 4.0 requires php 7.1)
    {
        return new Response($this->templating->render($this->template, $this->model->show($id, $request)));
    }
}
