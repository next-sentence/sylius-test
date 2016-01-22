<?php

namespace AppBundle\AttributeType;

use AppBundle\Entity\AttributeValue;
use Sylius\Component\Attribute\AttributeType\AttributeTypeInterface;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class IntervalAttributeType implements AttributeTypeInterface
{
    const TYPE = 'interval';

    public function getStorageType()
    {
        return AttributeValue::STORAGE_ARRAY;
    }

    public function getType()
    {
        return self::TYPE;
    }

    public function validate(AttributeValueInterface $attributeValue, ExecutionContextInterface $context, array $configuration)
    {
//        $value = $attributeValue->getValue();
//
//        $value = explode('-', $value);
//
//        $error = $context->getValidator()->validate($value,'');
//
//        if ($error) {
//            $context
//                ->buildViolation($error->getMessage())
//                ->atPath('value')
//                ->addViolation()
//            ;
//        }

    }
}