autologin-bundle
================

When you receive a notification, invitation, etc. by email with a URL to your site, you have to login everytime.
With this module, you will login automatically when you click on URL, it's too easy.
Come on!

## Branch to use with sopinet user bundle
## Prerequisites

This module works with FOSUserBundle ([see Documentation](https://github.com/FriendsOfSymfony/FOSUserBundle))

## Installation

### composer.json

``` bash
$ php composer.phar require sopinet/autologin-bundle 'dev-master'
```

### AppKernel.php

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Sopinet\AutologinBundle\SopinetAutologinBundle(),
    );
}
```

### config.yml

``` yaml
# app/config/config.yml
sopinet_autologin:
    domain: http://domain.com

```

### routing.yml

``` yaml
# app/config/routing.yml
sopinet_autologin:
    resource: "@SopinetAutologinBundle/Resources/config/routing.yml"
    prefix:   /

```

## How to use

Generate the URL

``` php
<?php
$url = $this->container->get('urlhelper')->generateUrl($route, $user);

$message = \Swift_Message::newInstance()
		->setSubject(...)
		->setFrom(...)
		->setTo(...)
		->setBody($this->container->get('templating')->render('your_template.html.twig', array('url' => $url)), 'text/html');
```

