<?php

namespace Fyb\Bundle\AttributeBundle\Form\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class FrontendWidgetFormSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'addFrontendWidgetField',
        );
    }

    /**
     * @param FormEvent $event
     */
    public function addFrontendWidgetField(FormEvent $event)
    {
        $form = $event->getForm();

        $attribute = $event->getData();
        $attributeType = ucfirst($attribute->getType()).'AttributeType';

        $form->add('frontendWidget', 'choice', array(
            'label' => 'Frontend widget',
            'choices' => call_user_func(array("Fyb\\Component\\Attribute\\AttributeType\\".$attributeType, 'getFrontendWidgetChoicesList')),
        ));
    }
}
