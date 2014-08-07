<?php

namespace Auto\AutologinBundle\Service;

class AutologinHelper {			
	function __construct($entityManager, $container, $router) {
		$this->em = $entityManager;
		$this->container = $container;
		$this->router = $router;
	}

	/**
	 * Funcion para generar path autologin	 
	 */
	public function generatePath() {
		$url = "url email";
		return $url;
	}
}