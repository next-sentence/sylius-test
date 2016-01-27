<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Attribute;
use Sylius\Bundle\AttributeBundle\Controller\AttributeController as BaseAttributeController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AttributeController extends BaseAttributeController
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function renderAttributeValueFormsAction(Request $request)
    {
        $attributeRepository = $this->get('sylius.repository.product_attribute');
        $forms = array();

        $choices = ($request->query->has('sylius_product_attribute_choice')) ? $request->query->get('sylius_product_attribute_choice') : array();
        /** @var  $attributes Attribute[] */
        $attributes = $attributeRepository->findBy(array('id' => $choices));
        foreach ($attributes as $attribute) {
            $attributeForm = sprintf('sylius_attribute_type_%s_%s', $attribute->getType(), $attribute->getBackendWidget());
            $options = array(
                'label' => $attribute->getName(),
            );

            $form = $this->get('form.factory')->createNamed('value', $attributeForm, null, $options);
            $forms[$attribute->getId()] = $form->createView();
        }

        return $this->render('SyliusAttributeBundle::attributeValueForms.html.twig', array('forms' => $forms, 'count' => $request->query->get('count')));
    }
}
