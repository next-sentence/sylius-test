<?php

namespace Fyb\Bundle\AttributeBundle\Doctrine\ORM;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Fyb\Component\Attribute\Model\Archetype;
use Fyb\Component\Attribute\Model\Attribute;

class AttributeWidgetRepository extends EntityRepository
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
