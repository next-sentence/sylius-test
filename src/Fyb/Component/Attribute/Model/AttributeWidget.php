<?php

namespace Fyb\Component\Attribute\Model;

use Sylius\Component\Resource\Model\ResourceInterface;

class AttributeWidget implements ResourceInterface
{
    /** @var  integer */
    protected $id;

    /** @var  Archetype */
    protected $archetype;

    /** @var  Attribute */
    protected $attribute;

    /** @var  string */
    protected $backendWidget;

    /** @var  string */
    protected $frontendWidget;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Archetype
     */
    public function getArchetype()
    {
        return $this->archetype;
    }

    /**
     * @param Archetype $archetype
     */
    public function setArchetype($archetype)
    {
        $this->archetype = $archetype;
    }

    /**
     * @return Attribute
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param Attribute $attribute
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * @return string
     */
    public function getBackendWidget()
    {
        return $this->backendWidget;
    }

    /**
     * @param string $backendWidget
     */
    public function setBackendWidget($backendWidget)
    {
        $this->backendWidget = $backendWidget;
    }

    /**
     * @return string
     */
    public function getFrontendWidget()
    {
        return $this->frontendWidget;
    }
    /**
     * @param string $frontendWidget
     */
    public function setFrontendWidget($frontendWidget)
    {
        $this->frontendWidget = $frontendWidget;
    }
}
