<?php

namespace Fyb\Bundle\WebBundle\EventListener;

use Sylius\Bundle\WebBundle\Event\MenuBuilderEvent;

class MenuBuilderListener
{
    /**
     * {@inheritdoc}
     */
    public function addBackendMenuItemsMain(MenuBuilderEvent $event)
    {
        $menu = $event->getMenu();

        if ($child = $menu->getChild('customer')) {
            $child->addChild(
                'stores',
                array(
                    'route' => 'fyb_backend_store_index',
                    'labelAttributes' => array('icon' => 'glyphicon glyphicon-stats'),
                )
            )->setLabel('Stores');
        }

        $childOptions = array(
            'attributes'         => array('class' => 'dropdown'),
            'childrenAttributes' => array('class' => 'dropdown-menu'),
            'labelAttributes'    => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'href' => '#'),
        );

        $child = $menu
            ->addChild('listings', $childOptions)
            ->setLabel('Listing')
        ;
        $child->addChild('category', array(
            'route' => 'fyb_backend_taxonomy_index',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-stats'),
        ))->setLabel('Catalog');
    }

    /**
     * {@inheritdoc}
     */
    public function addBackendMenuItemsSidebar(MenuBuilderEvent $event)
    {
        $menu = $event->getMenu();

        if ($child = $menu->getChild('customer')) {
            $child->addChild(
                'stores',
                array(
                    'route' => 'fyb_backend_store_index',
                    'labelAttributes' => array('icon' => 'glyphicon glyphicon-stats'),
                )
            )->setLabel('Stores');
        }

        $childOptions = array(
            'childrenAttributes' => array('class' => 'nav'),
            'labelAttributes'    => array('class' => 'nav-header'),
        );

        $child = $menu
            ->addChild('listings', $childOptions)
            ->setLabel('Listing')
        ;
        $child->addChild('category', array(
            'route' => 'fyb_backend_taxonomy_index',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-stats'),
        ))->setLabel('Catalog');
    }
}