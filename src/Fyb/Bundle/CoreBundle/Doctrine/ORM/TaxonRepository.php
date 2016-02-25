<?php

namespace Fyb\Bundle\CoreBundle\Doctrine\ORM;

use Sylius\Bundle\TaxonomyBundle\Doctrine\ORM\TaxonRepository as BaseTaxonRepository;
use Sylius\Component\Taxonomy\Model\TaxonomyInterface;
use Fyb\Component\Attribute\Model\Archetype;

class TaxonRepository extends BaseTaxonRepository
{
    /**
     * @param TaxonomyInterface $taxonomy
     * @param Archetype|null    $archetype
     * @return array
     */
    public function getTaxonsAsListByArchetype(TaxonomyInterface $taxonomy, Archetype $archetype = null)
    {
        $queryBuilder = $this->getQueryBuilder()
            ->where('o.taxonomy = :taxonomy')
            ->andWhere('o.parent IS NOT NULL')
            ->setParameter('taxonomy', $taxonomy)
            ;

        if ($archetype) {
            $type = $archetype->getType();
            $queryBuilder->andWhere('o.'.$type.'Archetype =:type')
                ->setParameter('type', $archetype);
        }

        return $queryBuilder
            ->orderBy('o.left')
            ->getQuery()
            ->getResult();
    }
}
