<?php

namespace AppBundle\Entity;

use Sylius\Component\Product\Model\Archetype as BaseArchetype;

class Archetype extends BaseArchetype
{
    const PRODUCT_TYPE = 'product';
    const SERVICE_TYPE  = 'service';

    /** @var  string */
    protected $type;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public static function getTypeLabels()
    {
        return array(
            self::PRODUCT_TYPE => 'Product',
            self::SERVICE_TYPE => 'Service',
        );
    }
}