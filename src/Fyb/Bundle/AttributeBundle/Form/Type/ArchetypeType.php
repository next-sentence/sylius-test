<?php

namespace Fyb\Bundle\AttributeBundle\Form\Type;

use Sylius\Bundle\ArchetypeBundle\Form\Type\ArchetypeType as BaseArchetypeType;
use Symfony\Component\Form\FormBuilderInterface;
use Fyb\Component\Attribute\Model\Archetype;

class ArchetypeType extends BaseArchetypeType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->remove('attributes')
            ->add('type', 'choice', array(
                'label'   => 'Type',
                'choices' => Archetype::getTypeLabels(),
                'expanded' => true,
            ))
            ->add('widgets', 'collection', array(
                'required'     => false,
                'type'         => 'sylius_product_archetype_attribute_widget',
                'prototype' => false,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
            ))
        ;
    }
}
