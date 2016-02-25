<?php

namespace Fyb\Bundle\WebBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FybWebBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'SyliusWebBundle';
    }

}
