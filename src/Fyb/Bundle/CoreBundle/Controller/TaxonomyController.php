<?php

namespace Fyb\Bundle\CoreBundle\Controller;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class TaxonomyController extends ResourceController
{
    protected function isGrantedOr403($permission)
    {
        if (!$this->container->has('sylius.authorization_checker')) {
            return true;
        }

        $permission = $this->config->getPermission($permission);

        if ($permission) {
            $grant = sprintf('%s.%s.%s', $this->config->getBundlePrefix(), $this->config->getResourceName(), $permission);
            if ($this->get('sylius.authorization_checker')->isGranted(sprintf('fyb.catalog.%s', $permission))) {
                return true;
            }

            if (!$this->get('sylius.authorization_checker')->isGranted($grant)) {
                throw new AccessDeniedException(sprintf('Access denied to "%s" for "%s".', $grant, $this->getUser() ? $this->getUser()->getUsername() : 'anon.'));
            }
        }
    }

}
