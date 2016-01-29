<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Archetype;
use Sylius\Bundle\CoreBundle\Form\Type\TaxonType as BaseTaxonType;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;

class TaxonType extends BaseTaxonType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('productArchetype', 'entity', array(
                'empty_value' => '---',
                'class' => Archetype::class,
                'query_builder' => function (EntityRepository $repository) {
                    return $repository
                        ->createQueryBuilder('o')
                        ->where('o.type = :type')
                        ->setParameter('type', Archetype::PRODUCT_TYPE)
                    ;
                }
            ))
            ->add('serviceArchetype', 'entity', array(
                'empty_value' => '---',
                'class' => Archetype::class,
                'query_builder' => function (EntityRepository $repository) {
                    return $repository
                        ->createQueryBuilder('o')
                        ->where('o.type = :type')
                        ->setParameter('type', Archetype::SERVICE_TYPE)
                    ;
                }
            ))
        ;
    }
}