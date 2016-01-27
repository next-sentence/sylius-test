<?php

namespace AppBundle\AttributeType;

use Sylius\Component\Attribute\AttributeType\DateAttributeType as BaseDateAttributeType;

class DateAttributeType extends BaseDateAttributeType implements AttributeTypeInterface
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
            self::DROPDOWN => '3 Dropdowns',
        );
    }
}