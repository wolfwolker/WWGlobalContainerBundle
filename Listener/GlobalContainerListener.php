<?php

namespace WW\WWGlobalContainerBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use WW\WWGlobalContainerBundle\Model\Sf;

class GlobalContainerListener extends ContainerAware
{
	public function onKernelRequest(GetResponseEvent $event)
	{
		if($event->getRequestType() == HttpKernelInterface::MASTER_REQUEST)
			Sf::setContainer($this->container);
	}
}
