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
        $builder
            ->add('start', 'date', array(
                'attr' => array('class' => 'start_date_picker'),
                'widget'         => 'single_text',
                'format'         => 'M/d/y',
                'model_timezone' => 'UTC',
                'view_timezone'  => 'UTC',
            ))
            ->add('end', 'date', array(
                'attr' => array('class' => 'end_date_picker'),
                'widget'         => 'single_text',
                'format'         => 'M/d/y',
                'model_timezone' => 'UTC',
                'view_timezone'  => 'UTC',
            ))
        ;
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
        return 'sylius_attribute_type_interval_calendar';
    }
}
