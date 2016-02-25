<?php

namespace Fyb\Bundle\StoreBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
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
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->add('name', 'text', array(
                'required' => false,
                'label'    => 'fyb.form.store.name',
            ))
            ->add('address', 'textarea', array(
                'required' => false,
                'label'    => 'fyb.form.store.address',
            ))
            ->add('geoloc', 'textarea', array(
                'required' => false,
                'label'    => 'fyb.form.store.geoloc',
            ))
            ->add('enabled', 'checkbox', array(
                'required' => false,
                'label'    => 'fyb.form.store.enabled',
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
