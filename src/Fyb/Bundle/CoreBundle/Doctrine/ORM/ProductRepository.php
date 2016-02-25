<?php

namespace Fyb\Bundle\CoreBundle\Doctrine\ORM;

use Fyb\Component\Core\Model\Taxon;
use Fyb\Component\Store\Model\Store;
use Pagerfanta\Pagerfanta;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository as BaseProductRepository;

class ProductRepository extends BaseProductRepository
{
    /**
     * Create paginator for products categorized under given taxon and store.
     * @param Taxon      $taxon
     * @param Store|null $store
     * @param array      $criteria
     * @return Pagerfanta
     */
    public function createByTaxonAndStorePaginator(Taxon $taxon, Store $store = null, array $criteria = array())
    {
        $queryBuilder = $this->getCollectionQueryBuilder();
        $queryBuilder
            ->innerJoin('product.taxons', 'taxon')
            ->innerJoin('product.store', 'store')
            ->andWhere($queryBuilder->expr()->orX(
                'taxon = :taxon',
                ':left < taxon.left AND taxon.right < :right'
            ))
            ->andWhere('store = :store')
            ->setParameter('taxon', $taxon)
            ->setParameter('store', $store)
            ->setParameter('left', $taxon->getLeft())
            ->setParameter('right', $taxon->getRight())
        ;

        $this->applyCriteria($queryBuilder, $criteria);

        return $this->getPaginator($queryBuilder);
    }
}
