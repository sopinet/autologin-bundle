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
	public function generateUrl($path, $user) {				
				
		if (null === $user->getConfirmationToken()) {
			/** @var $tokenGenerator \FOS\UserBundle\Util\TokenGeneratorInterface */
			$tokenGenerator = $this->container->get('fos_user.util.token_generator');
			$token = $tokenGenerator->generateToken();
			$user->setConfirmationToken($token);
			
			$this->em->persist($user);
			$this->em->flush();
		}
		else{
			$token = $user->getConfirmationToken();
		}

        $domain = $this->container->getParameter('sopinet_autologin.domain');

        $url = $domain . $this->router->generate('auto_login', array('path' => $path, 'token' => $token));

        return $url;
	}
}