<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Component\Product\Model\Attribute as BaseAttribute;

class Attribute extends BaseAttribute
{
    const REQUIREMENT_MANDATORY = 'mandatory';
    const REQUIREMENT_OPTIONAL  = 'optional';
    const REQUIREMENT_AUTOMATIC  = 'automatic';

    const FILTER_NOT_FILTERABLE = 'not_filterable';

    const FILTER_MULTIPLE_SELECTIONS  = 'Multiple selections';
    const CHECKBOXES = 'checkbox';
    const MULTIPLE_SELECT_LIST = 'multiple_select';
    const CHECKBOXES_WITH_AUTOCOMPLETE = 'checkbox_autocomplete';

    const FILTER_INTERVAL  = 'Interval';
    const MIN_MAX = 'min_max';
    const MIN = 'min';
    const MAX = 'max';
    const PREDEFINED = 'predefined';

    /** @var  string */
    protected $requirement = self::REQUIREMENT_MANDATORY;
    /** @var  string */
    protected $filter;
    /** @var  string */
    protected $backendWidget;
    /** @var  string */
    protected $frontendWidget;

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
     * @return mixed
     */
    public function getRequirement()
    {
        return $this->requirement;
    }

    /**
     * @param mixed $requirement
     */
    public function setRequirement($requirement)
    {
        $this->requirement = $requirement;
    }

    /**
     * @return string
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param string $filter
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
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

    /**
     * @return array
     */
    public static function getRequirementLabels()
    {
        return array(
            self::REQUIREMENT_MANDATORY => 'Mandatory',
            self::REQUIREMENT_OPTIONAL  => 'Optional',
            self::REQUIREMENT_AUTOMATIC  => 'Automatic',
        );
    }

    /**
     * @return array
     */
    public static function getFilterLabels()
    {
        return array(
            self::FILTER_NOT_FILTERABLE => 'Not filterable',
            self::FILTER_MULTIPLE_SELECTIONS => array(
                self::CHECKBOXES => 'Checkboxes',
                self::MULTIPLE_SELECT_LIST => 'Multiple select list',
                self::CHECKBOXES_WITH_AUTOCOMPLETE => 'Checkboxes with Autocomplete',
            ),
            self::FILTER_INTERVAL  => array(
                self::MIN_MAX => 'Min-Max',
                self::MIN => 'Min value only',
                self::MAX => 'Max value only',
                self::PREDEFINED => 'Predefined intervals',
            ),
        );
    }
}