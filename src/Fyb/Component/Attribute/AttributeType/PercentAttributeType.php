<?php

namespace Fyb\Component\Attribute\AttributeType;

use Sylius\Component\Attribute\AttributeType\PercentAttributeType as BasePercentAttributeType;

class PercentAttributeType extends BasePercentAttributeType implements AttributeTypeInterface
{
    const TEXT = 'text';
    const INPUT = 'input';

    /**
     * {@inheritdoc}
     */
    public static function getFrontendWidgetChoicesList()
    {
        return array(
            self::TEXT => 'Text',
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getBackendWidgetChoicesList()
    {
        return array(
            self::INPUT => 'Input field',
        );
    }
}
