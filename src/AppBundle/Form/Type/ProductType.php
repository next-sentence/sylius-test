<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Product;
use Sylius\Bundle\CoreBundle\Form\Type\ProductType as BaseProductType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends BaseProductType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('type', 'choice', array(
                'label'   => 'Type',
                'choices' => Product::getTypeLabels(),
                'data' => Product::PRODUCT_TYPE,
                'expanded' => true,
            ))
        ;
    }
}