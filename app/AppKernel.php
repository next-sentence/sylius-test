<?php

use Sylius\Bundle\CoreBundle\Kernel\Kernel;

class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = array(
            new \Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle(),
            new Fyb\Bundle\AttributeBundle\FybAttributeBundle(),
            new Fyb\Bundle\CoreBundle\FybCoreBundle(),
            new Fyb\Bundle\WebBundle\FybWebBundle(),
        );

        if (in_array($this->environment, array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
        }

        return array_merge(parent::registerBundles(), $bundles);
    }
}
