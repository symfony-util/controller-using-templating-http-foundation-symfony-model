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
use SymfonyUtil\Component\HttpFoundation\ControllerModelInterface;

class IndexController
{
    protected $model;
    protected $templating;
    protected $template;

    public function __construct(
        ControllerModelInterface $model,
        EngineInterface $templating,
        $template = 'index.html.twig'
    ) {
        $this->model = $model;
        $this->templating = $templating;
        $this->template = $template;
    }

    public function __invoke(Request $request = null)
    {
        // return new Response($this->templating->render($this->template, $this->viewModel->index($this->actionModel->index($request))));
        $model = $this->model;

        return new Response($this->templating->render($this->template, $model($request)));
    }
}
