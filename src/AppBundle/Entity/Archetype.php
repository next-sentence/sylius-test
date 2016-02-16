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

    /**
     * {@inheritdoc}
     */
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
    public function addWidget(AttributeWidget $widget)
    {
        if (!$this->hasWidget($widget)) {
            $widget->setArchetype($this);
            $widget->getArchetype()->addAttribute($widget->getAttribute());
            $this->widgets->add($widget);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeWidget(AttributeWidget $widget)
    {
        if ($this->hasWidget($widget)) {
            $this->widgets->removeElement($widget);
            $widget->getArchetype()->removeAttribute($widget->getAttribute());
            $widget->setArchetype(null);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasWidget(AttributeWidget $widget)
    {
        return $this->widgets->contains($widget);
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
