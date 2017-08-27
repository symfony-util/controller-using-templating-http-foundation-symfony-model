<?php

/*
 * This file is part of the Symfony-Util package.
 *
 * (c) Jean-Bernard Addor
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SymfonyUtil\Controller\TemplatingFoundationModel;

use ...\TraversableIndexInterface; // Needs another interface .../HttpFoundation/TraversableIndexInterface
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

class PagerIndexController
{
    protected $model
    protected $templating;
    protected $template;

    public function __construct(
        TraversableListInterface $model,
        EngineInterface $templating,
        $template = 'index.html.twig',
        $maxPerPage = 15
    )
    {
        $this->model = $model;
        $this->templating = $templating;
        $this->template = $template;
        $this->maxPerPage = $maxPerPage;
    }

    public function __invoke(
        Request $request = new Request()
    )
    {
        return new Response($this->templating->render($this->template, ['model' => $this->model->traversableList($request)));
    }
}
