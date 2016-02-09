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