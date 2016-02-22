<?php

namespace Fyb\Bundle\CoreBundle\EventListener;

use Fyb\Component\Store\Model\Store;
use Sylius\Component\Resource\Event\ResourceEvent;
use Sylius\Component\Resource\Factory\Factory;

class CustomerRegisterListener
{
    /**
     * @var Factory
     */
    protected $factory;

    /**
     * Constructor.
     *
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param ResourceEvent $event
     */
    public function preRegister(ResourceEvent $event)
    {
        $item = $event->getSubject();
        /** @var Store $store */
        $store = $this->factory->createNew();

        $store->setName($item->getEmail());
        $store->setCode($item->getEmail());
        $store->setEnabled(true);
        $item->getUser()->setStore($store);
    }
}