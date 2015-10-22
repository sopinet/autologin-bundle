<?php

namespace Sopinet\AutologinBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Application\Sopinet\UserBundle\Entity\User;

class AutoController extends Controller
{
    /**
     * Funcion que logea a un usuario con el token pasado y lo redirige al path pasado como parametro
     * @param $path
     * @param $token
     *
     * @return RedirectResponse
     * @Route("/auto/{path}/{token}", name="auto_login")
     */
    public function autologinAction($path, $token)
    {
    	$user = $this->container->get('security.context')->getToken()->getUser();

        $request = $this->container->get('request');
        $url = 'http://'.$request->getHost().$request->getBaseUrl().'/'.$path;

    	if($user != "anon."){
    		$response = new RedirectResponse($url);
    	}
    	else {
            $em = $this->container->get('doctrine.orm.default_entity_manager');
            $reUser = $em->getRepository($this->container->getParameter('sopinet_autologin.userRepository'));
    		$user = $reUser->findOneByConfirmationToken($token);
    		
    		$response = new RedirectResponse($url);
    		if($user != null) {
                $this->authenticateUser($user, $response);

                $user->setConfirmationToken(null);
                $em->persist($user);
                $em->flush();
            }
    	}
    	
    	return $response;
    }
    	
    protected function authenticateUser(User $user, Response $response)
   	{
    	try {
    		$this->container->get('fos_user.security.login_manager')->loginUser(
    				$this->container->getParameter('fos_user.firewall_name'),
    				$user,
    				$response);
    	} catch (AccountStatusException $ex) {
    		// We simply do not authenticate users which do not pass the user
    		// checker (not enabled, expired, etc.).
    	}
    }   
}
