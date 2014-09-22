<?php

namespace Richpolis\FrontendBundle\Listener;
 
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
 
class LoginListener
{
    private $contexto, $router, $usuario = null;
 
    public function __construct(SecurityContext $context, Router $router)
    {
        $this->contexto = $context;
        $this->router   = $router;
    }
 
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $token = $event->getAuthenticationToken();
        $this->usuario = $token->getUser();
    }
 
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (null != $this->usuario){
            if($this->usuario->getActive()) {
                if($this->contexto->isGranted('ROLE_ADMIN')){
                    $irA = $this->router->generate('usuarios');
                }else{
                    $irA = $this->router->generate('homepage');
                }
            }else{
                $irA = $this->router->generate('logout');
            }
            $event->setResponse(new RedirectResponse($irA));
            $event->stopPropagation();
        }
    }
}