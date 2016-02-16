<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Attribute;
use AppBundle\Form\EventSubscriber\BackendWidgetFormSubscriber;
use AppBundle\Form\EventSubscriber\FrontendWidgetFormSubscriber;
use Sylius\Bundle\AttributeBundle\Form\Type\AttributeType as BaseAttributeType;
use Symfony\Component\Form\FormBuilderInterface;

class AttributeType extends BaseAttributeType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('requirement', 'choice', array(
                'label'   => 'Requirement',
                'choices' => Attribute::getRequirementLabels(),
                'expanded' => true,
            ))
            ->add('filter', 'choice', array(
                'label'   => 'Filter',
                'choices' => Attribute::getFilterLabels(),
            ))
            ->addEventSubscriber(new FrontendWidgetFormSubscriber())
            ->addEventSubscriber(new BackendWidgetFormSubscriber())
        ;
    }
}
