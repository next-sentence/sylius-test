<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Attribute;
use AppBundle\Entity\AttributeWidget;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttributeWidgetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder->add('attribute', 'sylius_product_attribute_choice', array(
                'required' => false,
                'attr' => array('class' => 'hidden'),
                'label'    => false,
            ));

//        $builder->add('attribute', 'entity_hidden', array(
//            'data_class' => Attribute::class,
//        ));

        $formModifier = function(FormInterface $form, $data = null) {
            $frontendChoices = $backendChoices = array();
            if ($data instanceof AttributeWidget) {
                $data = $data->getAttribute();
            }
            if($data instanceof Attribute) {
                $attributeType = ucfirst($data->getType()).'AttributeType';
                $frontendChoices = call_user_func(array("AppBundle\\AttributeType\\".$attributeType, 'getFrontendWidgetChoicesList'));
                $backendChoices = call_user_func(array("AppBundle\\AttributeType\\".$attributeType, 'getBackendWidgetChoicesList'));
            }

            $form
                ->add('frontendWidget', 'choice', array(
                    'label' => 'Frontend widget',
                    'choices' => $frontendChoices,
                ))
                ->add('backendWidget',  'choice', array(
                    'label' => 'Backend widget',
                    'choices' => $backendChoices,
                ));
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                $formModifier($event->getForm(), $event->getData());
            }
        );

        $builder->get('attribute')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $formModifier($event->getForm()->getParent(), $event->getForm()->getData());
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => AttributeWidget::class,
        ));
    }

    public function getName()
    {
        return 'sylius_product_archetype_attribute_widget';
    }
}