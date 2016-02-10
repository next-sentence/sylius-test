<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Product;
use AppBundle\Entity\Taxon;
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

        $product = $options['data'];
        $archetype = $product->getArchetype();
        $builder
            ->add('attributes', 'collection', array(
                'required'     => false,
                'type'         => 'sylius_product_attribute_value',
                'prototype' => false,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'options' => array(
                    'archetype' => $archetype,
                ),
            ))
            ->add('taxons', 'sylius_taxon_selection', array(
                'archetype' => $archetype,
            ))
            ->add('mainTaxon', 'sylius_taxon_choice', array(
                'label' => 'sylius.form.product.main_taxon',
                'filter' => function (Taxon $taxon) use ($archetype) {
                    if ($archetype) {
                        $getArchetype = sprintf('get%sArchetype', ucfirst($archetype->getType()));
                        return $taxon->$getArchetype() === $archetype;
                    }
                    return true;
                }
            ))
            ->add('type', 'choice', array(
                'label'   => 'Type',
                'choices' => Product::getTypeLabels(),
                'data' => Product::PRODUCT_TYPE,
                'expanded' => true,
            ))
        ;
    }
}