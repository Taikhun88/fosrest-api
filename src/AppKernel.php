<?php

namespace App\Controller;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

abstract class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // …
        ];
    }
    // …
}
