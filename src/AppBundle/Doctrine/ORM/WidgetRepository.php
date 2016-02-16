<?php

namespace AppBundle\Doctrine\ORM;

use AppBundle\Entity\Archetype;
use AppBundle\Entity\Attribute;
use Doctrine\ORM\EntityRepository;

class WidgetRepository extends EntityRepository
{
    /**
     * @param Attribute      $attribute
     * @param Archetype|null $archetype
     * @return array
     */
    public function getAttributeWidget(Attribute $attribute, Archetype $archetype = null)
    {
       return $this->createQueryBuilder('w')
           ->leftJoin('w.archetype', 'archetype')
           ->leftJoin('w.attribute', 'attribute')
           ->where('attribute = :attribute')
           ->andWhere('archetype = :archetype')
           ->setParameter(':attribute', $attribute)
           ->setParameter(':archetype', $archetype)
           ->getQuery()
           ->getOneOrNullResult();
    }
}