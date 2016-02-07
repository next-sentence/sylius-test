<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Component\Product\Model\Archetype as BaseArchetype;

class Archetype extends BaseArchetype
{
    const PRODUCT_TYPE = 'product';
    const SERVICE_TYPE  = 'service';

    /** @var  string */
    protected $type;

    /** @var  AttributeWidget[]|ArrayCollection */
    protected $widgets;

    public function __construct()
    {
        parent::__construct();

        $this->widgets = new ArrayCollection();
    }

    /**
     * @return AttributeWidget[]|ArrayCollection
     */
    public function getWidgets()
    {
        return $this->widgets;
    }

    /**
     * @param AttributeWidget[]|ArrayCollection $widgets
     */
    public function setWidgets($widgets)
    {
        $this->widgets = $widgets;
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
    * {@inheritdoc}
     */
    public function addWidget(AttributeWidget $attribute)
    {
        if (!$this->hasWidget($attribute)) {
            $attribute->setArchetype($this);
            $this->widgets->add($attribute);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeWidget(AttributeWidget $attribute)
    {
        if ($this->hasAttribute($attribute)) {
            $this->widgets->removeElement($attribute);
            $attribute->setArchetype(null);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasWidget(AttributeWidget $attribute)
    {
        return $this->widgets->contains($attribute);
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