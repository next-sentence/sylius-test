<?php

namespace AppBundle\AttributeType;

use AppBundle\Entity\AttributeValue;
use AppBundle\Entity\Attribute;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class IntervalAttributeType implements AttributeTypeInterface
{
    const TYPE = 'interval';

    const CALENDAR = 'calendar';
    const TEXT = 'text';

    /**
     * {@inheritdoc}
     */
    public function getStorageType()
    {
        return AttributeValue::STORAGE_ARRAY;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return self::TYPE;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(AttributeValueInterface $attributeValue, ExecutionContextInterface $context, array $configuration)
    {
        /*$value = $attributeValue->getValue();

        foreach ($this->getValidationErrors($context, $value, $configuration) as $error) {
            $context
                ->buildViolation($error->getMessage())
                ->atPath('value')
                ->addViolation()
            ;
        }*/
    }

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
            self::CALENDAR => 'Calendar selector',
        );
    }

    /**
     * {@inheritdoc}
     */
    private function getValidationErrors(ExecutionContextInterface $context, $value, array $validationConfiguration)
    {
        $validator = $context->getValidator();

        return $validator->validate(
            $value,
            new GreaterThan(new \DateTime())
        );
    }
}