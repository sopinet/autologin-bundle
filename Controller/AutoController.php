<?php

namespace Sopinet\AutologinBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AutoController extends Controller
{   
    /**
     * @Route("/auto", name="auto")     
     */
    public function autologinAction()
    {    	
    	ldd("come on");
    	return array();
    }
}
