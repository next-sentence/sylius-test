<?php

namespace AppBundle\AttributeType;

use Sylius\Component\Attribute\AttributeType\TextareaAttributeType as BaseTextareaAttributeType;

/**
 *
 */
class TextareaAttributeType extends BaseTextareaAttributeType implements AttributeTypeInterface
{
    const TEXT = 'text';
    const TEXTAREA = 'textarea';

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
            self::TEXTAREA => 'Textarea',
        );
    }
}