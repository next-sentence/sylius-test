<?php

namespace AppBundle\Form\Type\AttributeType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IntervalAttributeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * Form should depend on backend widget
         */
        $builder->add('start', 'date', array(
                'required'       => false,
                'widget'         => 'single_text',
                'format'         => 'y/M/d',
                'model_timezone' => 'UTC',
                'view_timezone'  => 'UTC',
            )
        );
        $builder->add('end', 'date', array(
                'required'       => false,
                'widget'         => 'single_text',
                'format'         => 'y/M/d',
                'model_timezone' => 'UTC',
                'view_timezone'  => 'UTC',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sylius_attribute_type_interval';
    }
}
