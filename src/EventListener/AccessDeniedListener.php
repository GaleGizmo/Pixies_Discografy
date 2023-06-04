<?php

namespace App\EventListener;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AccessDeniedListener
{
    private $router;
    private $session;

    public function __construct(RouterInterface $router, RequestStack $requestStack)
    {
        $this->router = $router;
        $this->session = $requestStack->getSession();
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        if ($exception instanceof AccessDeniedException) {
            $this->session->set('error_message', 'No tienes permiso para acceder a esta área.');
            $url = $this->router->generate('home');
            $response = new RedirectResponse($url);
            $event->setResponse($response);
        }
    }
}
