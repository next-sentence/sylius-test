<?php

namespace Fyb\Bundle\AttributeBundle\Form\Type;

use Sylius\Bundle\AttributeBundle\Form\Type\AttributeType as BaseAttributeType;
use Symfony\Component\Form\FormBuilderInterface;
use Fyb\Bundle\AttributeBundle\Form\EventSubscriber\BackendWidgetFormSubscriber;
use Fyb\Bundle\AttributeBundle\Form\EventSubscriber\FrontendWidgetFormSubscriber;
use Fyb\Component\Attribute\Model\Attribute;

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
