<?php

namespace App\Controller;

use JMS\SerializerBundle\JMSSerializerBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

abstract class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // …
            new JMSSerializerBundle,
        ];

        // …
    }
    // …
}
