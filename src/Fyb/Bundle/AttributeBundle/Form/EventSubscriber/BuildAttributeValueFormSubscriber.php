<?php

namespace Fyb\Bundle\AttributeBundle\Form\EventSubscriber;

use Sylius\Bundle\AttributeBundle\Form\EventSubscriber\BuildAttributeValueFormSubscriber as BaseBuildAttributeValueFormSubscriber;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Fyb\Component\Attribute\Model\Archetype;
use Fyb\Component\Attribute\Model\Attribute;

class BuildAttributeValueFormSubscriber extends BaseBuildAttributeValueFormSubscriber
{
    /** @var Archetype|null  */
    private $archetype;
    /**
     * @param RepositoryInterface $attributeRepository
     * @param Archetype|null      $archetype
     */
    public function __construct(RepositoryInterface $attributeRepository, Archetype $archetype = null)
    {
        parent::__construct($attributeRepository);

        $this->archetype = $archetype;
    }
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

        /** @var Attribute $attribute */
        $attribute = $this->attributeRepository->find($attributeValue['attribute']);

        $this->addValueField($form, $attribute);
    }

    /**
     * @param FormInterface $form
     * @param Attribute $attribute
     */
    private function addValueField(FormInterface $form, Attribute $attribute)
    {
        $options = array('auto_initialize' => false, 'label' => $attribute->getName());

        $form->add('value', sprintf('sylius_attribute_type_%s_%s', $attribute->getType(), $attribute->getBewWidgetByArchetype($this->archetype)), $options);
    }
}
