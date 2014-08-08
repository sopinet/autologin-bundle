<?php

namespace Sopinet\AutologinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Application\Sonata\UserBundle\Entity\User;

class AutoController extends Controller
{   
    /**
     * @Route("/auto/{path}/{token}", name="auto_login")     
     */
    public function autologinAction($path, $token)
    {    	
    	$user = $this->container->get('security.context')->getToken()->getUser();
    	 
    	if($user != "anon."){
    		$response = new RedirectResponse($this->get('router')->generate($path));
    	}
    	else {
    		$em = $this->getDoctrine()->getManager();
    		$reUser = $em->getRepository('ApplicationSonataUserBundle:User');
    		$user = $reUser->findOneByConfirmationToken($token);
    		
    		$response = new RedirectResponse($this->get('router')->generate($path));
    		 
    		$this->authenticateUser($user, $response);
    	
    		$user->setConfirmationToken(null);
    		$em->persist($user);
    		$em->flush();
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