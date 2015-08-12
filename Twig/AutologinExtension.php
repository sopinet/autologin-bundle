<?php

namespace Sopinet\AutologinBundle\Twig;
use Sopinet\AutologinBundle\Service\UrlHelper;


/**
 * Twig Extension - Mercolive
 * Has a dependency to the apache intl module
 */
class AutologinExtension extends \Twig_Extension
{
    /** @var  UrlHelper $_urlHelper */
    private $_urlHelper;

    /**
     * Constructor de la extension twig
     * @param UrlHelper $urlHelper
     *
     */
    public function __construct(UrlHelper $urlHelper)
    {
        $this->_urlHelper = $urlHelper;
    }

    /**
     * Obtiene los filtros definidos
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('autologinUrl', array($this, 'getAutologinUrl')),
        );
    }


    /**
     * Devuelve el nombre de la extensión
     * @return string
     */
    public function getName()
    {
        return 'sopinet_autologin_extension';
    }

    /**
     * Devuelve una url con autologin para un path y un user determinados
     *
     * @param string $path
     * @param $user
     *
     */
    public function getAutologinUrl($path='', $user)
    {
        return $this->_urlHelper->generateUrl($path,$user);
    }
}