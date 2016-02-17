<?php

namespace Fyb\Bundle\AttributeBundle\Form\Type;

use Sylius\Bundle\AttributeBundle\Form\Type\AttributeValueType as BaseAttributeValueType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Fyb\Bundle\AttributeBundle\Form\EventSubscriber\BuildAttributeValueFormSubscriber;

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
            ->addEventSubscriber(new BuildAttributeValueFormSubscriber($this->attributeRepository, $options['archetype']))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefaults(array(
                'archetype' => null,
            ))
        ;
    }
}
