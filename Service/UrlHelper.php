<?php

namespace Sopinet\AutologinBundle\Service;

class UrlHelper {			
	function __construct($entityManager, $container, $router) {
		$this->em = $entityManager;
		$this->container = $container;
		$this->router = $router;
	}

	/**
	 * Funcion para generar url autologin	 
	 */
	public function generateUrl() {
		$url = "url email";
		return $url;
	}
}