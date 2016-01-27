<?php

namespace AppBundle\AttributeType;

use Sylius\Component\Attribute\AttributeType\TextAttributeType as BaseTextAttributeType;

class TextAttributeType extends BaseTextAttributeType implements AttributeTypeInterface
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