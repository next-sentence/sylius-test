<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Attribute;
use AppBundle\Entity\AttributeWidget;
use AppBundle\Form\EventSubscriber\BackendWidgetFormSubscriber;
use AppBundle\Form\EventSubscriber\FrontendWidgetFormSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttributeWidgetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $attributeType = ucfirst($options['attribute_type']).'AttributeType';

        $builder
            ->add('frontendWidget', 'choice', array(
                'label' => 'Frontend widget',
                'choices' => call_user_func(array("AppBundle\\AttributeType\\".$attributeType, 'getFrontendWidgetChoicesList')),
            ))
            ->add('backendWidget',  'choice', array(
                'label' => 'Backend widget',
                'choices' => call_user_func(array("AppBundle\\AttributeType\\".$attributeType, 'getBackendWidgetChoicesList')),
            ));

        $builder
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($options) {
                $data = $event->getData();
                if (isset($data['attribute'])) {
                    $event->getForm()->add('attribute', 'entity_hidden', array(
                        'data_class' => $options['attribute_data_class'],
                    ));
                }
            })
        ;
//            ->addEventSubscriber(new FrontendWidgetFormSubscriber())
//            ->addEventSubscriber(new BackendWidgetFormSubscriber())
//        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => AttributeWidget::class,
            'attribute_data_class' => Attribute::class,
            'attribute_type' => 'text'
        ));
    }

    public function getName()
    {
        return 'sylius_product_archetype_attribute_widget';
    }
}