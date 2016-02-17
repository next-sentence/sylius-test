<?php

namespace Fyb\Component\Core\Model;

use Sylius\Component\Core\Model\Taxon as BaseTaxon;
use Fyb\Component\Attribute\Model\Archetype;

class Taxon extends BaseTaxon
{
    /** @var  Archetype */
    protected $productArchetype;
    /** @var  Archetype */
    protected $serviceArchetype;

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
