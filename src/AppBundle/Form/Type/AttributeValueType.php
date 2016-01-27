<?php

namespace AppBundle\Form\Type;

use AppBundle\Form\EventSubscriber\BuildAttributeValueFormSubscriber;
use Sylius\Bundle\AttributeBundle\Form\Type\AttributeValueType as BaseAttributeValueType;
use Symfony\Component\Form\FormBuilderInterface;

class AttributeValueType extends BaseAttributeValueType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('attribute', sprintf('sylius_%s_attribute_choice', $this->subjectName), array(
                'label' => sprintf('sylius.form.attribute.%s_attribute_value.attribute', $this->subjectName),
            ))
            ->addEventSubscriber(new BuildAttributeValueFormSubscriber($this->attributeRepository))
        ;
    }
}
