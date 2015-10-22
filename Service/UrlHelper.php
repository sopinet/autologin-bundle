<?php

namespace Sopinet\AutologinBundle\Service;

class UrlHelper {
    function __construct($container)
    {
        $this->container = $container;
    }


    /**
     * Funcion para generar un autologin
     * @param $path
     * @param $user
     * @return string
     */
    public function generateUrl($path, $user)
    {
        $this->em = $this->container->get('doctrine.orm.entity_manager');
        $this->router= $this->container->get('router');

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

        $url = $this->router->generate('auto_login', array('path' => $path, 'token' => $token), true);

        return $url;
    }
}