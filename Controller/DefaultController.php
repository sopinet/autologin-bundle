<?php

namespace Auto\AutologinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{   
    
    /**
     * @Route("/autologin", name="autologin")     
     */
    public function autologinAction()
    {    	
    	ldd("come on");
    	return array();
    }
}
