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
use SymfonyUtil\Component\HttpFoundation\ResponseParameters;

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
        $result = $this->model->__invoke($request);
        // Impired by:
        // https://github.com/symfony/symfony/blob/v3.3.6/src/Symfony/Bundle/FrameworkBundle/Controller/ControllerTrait.php
        /*
        if (array_key_exists('redirect', $result)) {
            $redirect = $result['redirect'];
            $status = 302;
            if (array_key_exists('status', $redirect)) {
                $status = $redirect['status'];
            }

            return new RedirectResponse($redirect['url'], $status);
        }
        */
        // redirectToRoute needs the router
        // ...

        $response = $result->getResponse();
        if ($response)) {
            $response->setContent($this->templating->render($this->template, $result->getParameters()));

            return $response;
        }

        return new Response($this->templating->render($this->template, $result->getParameters()));
    }
}
