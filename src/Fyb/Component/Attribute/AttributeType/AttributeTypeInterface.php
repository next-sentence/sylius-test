<?php

namespace Fyb\Component\Attribute\AttributeType;

use Sylius\Component\Attribute\AttributeType\AttributeTypeInterface as BaseAttributeTypeInterface;

interface AttributeTypeInterface extends BaseAttributeTypeInterface
{
    /**
     * @return array
     */
    public static function getFrontendWidgetChoicesList();

    /**
     * @return array
     */
    public static function getBackendWidgetChoicesList();
}
