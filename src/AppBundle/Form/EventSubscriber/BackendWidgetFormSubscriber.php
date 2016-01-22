<?php

namespace AppBundle\Form\EventSubscriber;

use AppBundle\AttributeType\IntervalAttributeType;
use Sylius\Component\Attribute\AttributeType\CheckboxAttributeType;
use Sylius\Component\Attribute\AttributeType\DateAttributeType;
use Sylius\Component\Attribute\AttributeType\IntegerAttributeType;
use Sylius\Component\Attribute\AttributeType\PercentAttributeType;
use Sylius\Component\Attribute\AttributeType\TextAttributeType;
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
        $attribute = $event->getData();
        $form = $event->getForm();

        $form->add('backendWidget', 'choice', array(
                'label' => 'Backend widget',
                'choices' => $this->getChoicesList($attribute->getType()),
            ));
    }

    public function getChoicesList($type)
    {
        switch ($type) {
            case CheckboxAttributeType::TYPE:
                $choiceList = array('checkbox', 'radio', 'dropdown');
                break;
            /*case ChoiceAttributeType::TYPE:
                $choiceList = array('list');
                break;*/
            /*case MoneyAttributeType::TYPE:
                $choiceList = array();
                break;*/
            case IntegerAttributeType::TYPE:
                $choiceList = array('input');
                break;
            case PercentAttributeType::TYPE:
                $choiceList = array('input');
                break;
            case TextAttributeType::TYPE:
                $choiceList = array('input');
                break;
            case DateAttributeType::TYPE:
                $choiceList = array('calendar', 'predefined', 'dropdown');
                break;
            case IntervalAttributeType::TYPE:
                $choiceList = array('date_selector');
                break;
            default:
                throw new \InvalidArgumentException('Invalid attribute type.');
        }

        return $choiceList;
    }
}