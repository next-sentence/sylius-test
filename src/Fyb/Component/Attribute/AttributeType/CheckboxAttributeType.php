<?php

namespace Fyb\Component\Attribute\AttributeType;

use Sylius\Component\Attribute\AttributeType\CheckboxAttributeType as BaseCheckboxAttributeType;

class CheckboxAttributeType extends BaseCheckboxAttributeType implements AttributeTypeInterface
{
    const CHECKBOX = 'checkbox';
    const RADIO = 'radio';
    const DROPDOWN = 'dropdown';

    /**
     * {@inheritdoc}
     */
    public static function getFrontendWidgetChoicesList()
    {
        return array(
            self::CHECKBOX => 'Checkbox',
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getBackendWidgetChoicesList()
    {
        return array(
            self::CHECKBOX => 'Checkbox',
            self::RADIO => 'Radio',
            self::DROPDOWN => 'Dropdown',
        );
    }
}
