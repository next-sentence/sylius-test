<?php

namespace Fyb\Component\Attribute\AttributeType;

use Sylius\Component\Attribute\AttributeType\DatetimeAttributeType as BaseDatetimeAttributeType;

class DatetimeAttributeType extends BaseDatetimeAttributeType implements AttributeTypeInterface
{
    const TEXT = 'text';
    const CALENDAR = 'calendar';
    const INPUT = 'input';
    const DROPDOWN = 'dropdown';

    /**
     * {@inheritdoc}
     */
    public static function getFrontendWidgetChoicesList()
    {
        return array(
            self::CALENDAR => 'Calendar',
            self::TEXT => 'Text',
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getBackendWidgetChoicesList()
    {
        return array(
//            self::CALENDAR => 'Calendar',
//            self::INPUT => 'Predefined input',
            self::DROPDOWN => '5 Dropdowns',
        );
    }
}
