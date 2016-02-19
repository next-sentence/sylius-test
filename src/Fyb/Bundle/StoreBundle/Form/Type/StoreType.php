<?php

namespace Fyb\Bundle\StoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class StoreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', 'text', array(
                'required' => false,
                'label'    => 'fyb.form.store.code',
            ))
            ->add('name', 'text', array(
                'required' => false,
                'label'    => 'fyb.form.store.code',
            ))
            ->add('address', 'text', array(
                'required' => false,
                'label'    => 'fyb.form.store.code',
            ))
            ->add('geoloc', 'text', array(
                'required' => false,
                'label'    => 'fyb.form.store.code',
            ))
            ->add('enabled', 'checkbox', array(
                'required' => false,
                'label'    => 'fyb.form.store.code',
            ))
        ;

    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'fyb_store';
    }
}
