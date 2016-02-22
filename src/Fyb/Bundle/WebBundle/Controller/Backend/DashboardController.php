<?php

namespace Fyb\Bundle\WebBundle\Controller\Backend;

use Sylius\Bundle\WebBundle\Controller\Backend\DashboardController as BaseDashboardController;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends BaseDashboardController
{
    const LISTING_MANAGER = 'listing_manager';

    /**
     * @return Response
     */
    public function mainAction()
    {
        if ($user = $this->getUser()) {
            $roles = $user->getAuthorizationRoles();
            foreach ($roles as $role) {
                if (self::LISTING_MANAGER === $role->getCode()) {
                    return $this->render('SyliusWebBundle:Backend/Dashboard:mainCustomer.html.twig');
                }
            }
        }

        return parent::mainAction();
    }
}
