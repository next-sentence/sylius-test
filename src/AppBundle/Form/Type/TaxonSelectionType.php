<?php

namespace AppBundle\Form\Type;

use Sylius\Bundle\TaxonomyBundle\Form\Type\TaxonSelectionType as BaseTaxonSelectionType;
use Sylius\Component\Taxonomy\Model\TaxonomyInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaxonSelectionType extends BaseTaxonSelectionType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $taxonomies = $this->taxonomyRepository->findAll();

        $archetype = $options['archetype'];

        $builder->addModelTransformer(new $options['model_transformer']['class']($taxonomies, $options['model_transformer']['save_objects']));

        foreach ($taxonomies as $taxonomy) {
            /* @var $taxonomy TaxonomyInterface */
            $builder->add($taxonomy->getId(), 'choice', array(
                'choice_list' => new ObjectChoiceList($this->taxonRepository->getTaxonsAsListByArchetype($taxonomy, $archetype), null, array(), null, 'id'),
                'multiple'    => $options['multiple'],
                'label'       => /* @Ignore */ $taxonomy->getName(),
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver
            ->setDefaults(array(
                'archetype'         => null,
            ))
        ;
    }
}
