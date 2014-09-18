autologin-bundle
================

When you receive a notification, invitation, etc. by email with a URL to your site, you have to login everytime.
With this module, you will login automatically when you click on URL, it's too easy.
Come on!

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
sopinet_autologin: ~

```

## How to use

You should generate a URL
$url = $this->container->get('urlhelper')->generateUrl($route, $user);

Send email with parameter url

.
.
.
