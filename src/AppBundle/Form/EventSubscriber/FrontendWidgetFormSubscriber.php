<?php

namespace AppBundle\Form\EventSubscriber;

use AppBundle\AttributeType\IntervalAttributeType;
use Sylius\Component\Attribute\AttributeType\CheckboxAttributeType;
use Sylius\Component\Attribute\AttributeType\DateAttributeType;
use Sylius\Component\Attribute\AttributeType\IntegerAttributeType;
use Sylius\Component\Attribute\AttributeType\PercentAttributeType;
use Sylius\Component\Attribute\AttributeType\TextareaAttributeType;
use Sylius\Component\Attribute\AttributeType\TextAttributeType;
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
        $attribute = $event->getData();
        $form = $event->getForm();

        $form->add('frontendWidget', 'choice', array(
            'label' => 'Frontend widget',
            'choices' => $this->getChoicesList($attribute->getType())
        ));
    }

    public function getChoicesList($type)
    {
        switch ($type) {
            case CheckboxAttributeType::TYPE:
                $choiceList = array('checkbox');
                break;
            /*case ChoiceAttributeType::TYPE:
                $choiceList = array('list);
                break;*/
            case IntegerAttributeType::TYPE:
                $choiceList = array('text');
                break;
            case PercentAttributeType::TYPE:
                $choiceList = array('text');
                break;
            case TextAttributeType::TYPE:
                $choiceList = array('text');
                break;
            case DateAttributeType::TYPE:
                $choiceList = array('calendar, text');
                break;
            case IntervalAttributeType::TYPE:
                $choiceList = array('calendar', 'text');
                break;
            default:
                throw new \InvalidArgumentException('Invalid attribute type.');
        }

        return $choiceList;
    }
}