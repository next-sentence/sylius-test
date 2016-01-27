<?php

namespace AppBundle\Form\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class BackendWidgetFormSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'addBackendWidgetField',
        );
    }

    /**
     * @param FormEvent $event
     */
    public function addBackendWidgetField(FormEvent $event)
    {
        $form = $event->getForm();

        $attribute = $event->getData();
        $attributeType = ucfirst($attribute->getType()).'AttributeType';

        $form->add('backendWidget', 'choice', array(
            'label' => 'Backend widget',
            'choices' => call_user_func(array("AppBundle\\AttributeType\\".$attributeType, 'getBackendWidgetChoicesList')),
        ));
    }

}