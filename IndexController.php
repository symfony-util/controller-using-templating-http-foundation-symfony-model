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

use PhpController\ViewModel\ArrayIndexInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
use SymfonyUtil\Component\HttpFoundation\IndexInterface;

class IndexController
{
    protected $actionModel
    protected $viewModel
    protected $templating;
    protected $template;

    public function __construct(
        IndexInterface $ActionModel,
        ArrayIndexInterface $viewModel,
        EngineInterface $templating,
        $template = 'index.html.twig',
    )
    {
        $this->actionModel = $actionModel;
        $this->viewModel = $viewModel;
        $this->templating = $templating;
        $this->template = $template;
    }

    public function __invoke(Request $request = new Request())
    {
        return new Response($this->templating->render($this->template, $this->viewModel->index($this->actionModel->index($request))));
    }
}
