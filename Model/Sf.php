<?php

namespace WW\WWGlobalContainerBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class Sf
{
	/**
	 * @var ContainerInterface
	 */
	protected static $container;

	/**
	 * @param ContainerInterface $container
	 */
	public static function setContainer(ContainerInterface $container)
	{
		self::$container = $container;
	}

	/**
	 * @param $service
	 *
	 * @return mixed
	 */
	public static function get($service)
	{
		return self::$container->get($service);
	}

	/**
	 * @return ContainerInterface
	 */
	public static function getContainer()
	{
		return self::$container;
	}

	/**
	 * @param $param
	 *
	 * @return mixed
	 */
	public static function getParameter($param)
	{
		return self::$container->getParameter($param);
	}

	public static function __callStatic($name, $arguments)
	{
		return call_user_func_array([self::$container, $name], $arguments);
	}

	/**
	 * @return Request
	 */
	public static function getRequest()
	{
		return self::$container->get('request');
	}

	/**
	 * Shortcut to Registry::getManager
	 *
	 * @param string|null $em
	 *
	 * @return ObjectManager
	 */
	public static function em($em = null)
	{
		return self::$container->get("doctrine")->getManager($em);
	}

	/**
	 * Shortcut to Registry::getManager::getRepository
	 *
	 * @param string $repo
	 * @param string|null $em
	 *
	 * @return ObjectRepository
	 */
	public static function getRepository($repo, $em = null)
	{
		return self::$container->get("doctrine")->getManager($em)->getRepository($repo);
	}

	/**
	 * Shortcut to Translator::trans
	 *
	 * @param string $translationKey
	 * @param array $parameters
	 * @param string $domain
	 *
	 * @return string
	 */
	protected function t($translationKey, $parameters = [], $domain = 'messages')
	{
		return self::$container->get("translator")->trans($translationKey, $parameters, $domain);
	}

	/**
	 * Shortcut to Router::generate
	 *
	 * @param string $route_name
	 * @param array $parameters
	 * @param bool $absolute
	 *
	 * @return string
	 */
	public static function l($route_name, $parameters = [], $absolute = false)
	{
		return self::$container->get("router")->generate($route_name, $parameters, $absolute);
	}
}
