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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
use SymfonyUtil\Component\HttpFoundation\StringControllerModelInterface;

class ShowController
{
    protected $model;
    protected $templating;
    protected $template;

    public function __construct(
        StringControllerModelInterface $model,
        EngineInterface $templating,
        $template = 'show.html.twig'
    ) {
        $this->model = $model;
        $this->templating = $templating;
        $this->template = $template;
    }

    public function __invoke($id, Request $request = null) // string $id since php 7.0 (Symfony 4.0 requires php 7.1)
    {
        // return new Response($this->templating->render($this->template, ($this->model->__invoke($id, $request))->getParameters()));
        // Error with php 5.6, but OK for newer ones.
        $responseParameters = $this->model->__invoke($id, $request);

        return new Response($this->templating->render($this->template, $responseParameters->getParameters()));
    }
}
