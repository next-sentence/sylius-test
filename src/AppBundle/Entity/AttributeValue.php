<?php

namespace AppBundle\Entity;

use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Sylius\Component\Product\Model\AttributeValue as BaseAttributeValue;

class AttributeValue extends BaseAttributeValue
{
    const STORAGE_ARRAY = 'array';

    /**
     * @var array
     */
    protected $array;

    /**
     * @return array
     */
    public function getArray()
    {
        return $this->array;
    }

    /**
     * @param array $array
     */
    public function setArray($array)
    {
        $this->array = $array;
    }

}
