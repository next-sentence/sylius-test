<?php

namespace AppBundle\Entity;

use Sylius\Component\Core\Model\Taxon as BaseTaxon;

class Taxon extends BaseTaxon
{
    /** @var  Archetype */
    public $productArchetype;
    /** @var  Archetype */
    public $serviceArchetype;

    /**
     * @return Archetype
     */
    public function getProductArchetype()
    {
        return $this->productArchetype;
    }

    /**
     * @param Archetype $productArchetype
     */
    public function setProductArchetype($productArchetype)
    {
        $this->productArchetype = $productArchetype;
    }

    /**
     * @return Archetype
     */
    public function getServiceArchetype()
    {
        return $this->serviceArchetype;
    }

    /**
     * @param Archetype $serviceArchetype
     */
    public function setServiceArchetype($serviceArchetype)
    {
        $this->serviceArchetype = $serviceArchetype;
    }
}
