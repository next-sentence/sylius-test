<?php

namespace AppBundle\Form\EventSubscriber;

use AppBundle\Entity\Attribute;
use Sylius\Bundle\AttributeBundle\Form\EventSubscriber\BuildAttributeValueFormSubscriber as BaseBuildAttributeValueFormSubscriber;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class BuildAttributeValueFormSubscriber extends BaseBuildAttributeValueFormSubscriber
{
    /**
     * @param FormEvent $event
     */
    public function preSetData(FormEvent $event)
    {
        $attributeValue = $event->getData();

        if (null === $attributeValue || null === $attributeValue->getAttribute()) {
            return;
        }

        $this->addValueField($event->getForm(), $attributeValue->getAttribute());
    }
    /**
     * @param FormEvent $event
     */
    public function preSubmit(FormEvent $event)
    {
        $attributeValue = $event->getData();

        if (!isset($attributeValue['value']) || !isset($attributeValue['attribute'])) {
            throw new \InvalidArgumentException('Cannot create an attribute value form on pre submit event without "attribute" and "value" keys in data.');
        }

        $form = $event->getForm();
        $attribute = $this->attributeRepository->find($attributeValue['attribute']);

        $this->addValueField($form, $attribute);
    }

    /**
     * @param FormInterface $form
     * @param AttributeInterface $attribute
     */
    private function addValueField(FormInterface $form, Attribute $attribute)
    {
        $options = array('auto_initialize' => false, 'label' => $attribute->getName());

        $form->add('value', sprintf('sylius_attribute_type_%s_%s', $attribute->getType(), $attribute->getBackendWidget()), $options);
    }
}
