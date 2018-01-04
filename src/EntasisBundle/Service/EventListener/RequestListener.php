<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27.12.17
 * Time: 14:23
 */

namespace EntasisBundle\Service\EventListener;


use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestListener
{
    public function onKernelRequest(GetResponseEvent $event)
    {

    }
}