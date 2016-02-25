<?php

namespace Fyb\Bundle\CoreBundle\Controller;

use Sylius\Bundle\CoreBundle\Controller\CustomerController as BaseCustomerController;
use Sylius\Component\Core\Model\Customer;

class CustomerController extends BaseCustomerController
{
    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        /** @var Customer $customer */
        $customer = parent::createNew();

        $user = $this->get('sylius.factory.user')->createNew();
        $user->addAuthorizationRole($this->get('sylius.repository.role')->findOneBy(array('code' => 'listing_manager')));
        $user->setCustomer($customer);

        return $customer;
    }
}
