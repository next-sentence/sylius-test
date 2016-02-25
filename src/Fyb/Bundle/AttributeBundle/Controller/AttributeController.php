<?php

namespace Fyb\Bundle\AttributeBundle\Controller;

use Sylius\Bundle\AttributeBundle\Controller\AttributeController as BaseAttributeController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Fyb\Component\Attribute\Model\Archetype;
use Fyb\Component\Attribute\Model\Attribute;
use Fyb\Component\Attribute\Model\AttributeWidget;

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

        return $this->render('FybAttributeBundle::attributeValueForms.html.twig', array('forms' => $forms, 'count' => $request->query->get('count')));
    }

    /**
     * @return Response
     */
    public function renderAttributesAction()
    {
        $form = $this->get('form.factory')->create(
            'sylius_product_attribute_choice',
            null,
            array(
                'expanded' => true,
                'multiple' => true,
            )
        );

        $view = $this->get('request_stack')->getCurrentRequest()->get('widget', 'SyliusAttributeBundle::attributeChoice.html.twig');

        return $this->render($view, array('form' => $form->createView()));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function renderAttributeWidgetFormsAction(Request $request)
    {
        $attributeRepository = $this->get('sylius.repository.product_attribute');
        /** @var Archetype $archetype */
        $archetype = $this->get('sylius.repository.product_archetype')->find($request->query->get('archetype_parent', 0));
        $forms = array();
        $choices = ($request->query->has('sylius_product_attribute_choice')) ? $request->query->get('sylius_product_attribute_choice') : 0;
        /** @var  $attributes Attribute[] */
        $attributes = $attributeRepository->findBy(array('id' => $choices));

        if ($archetype && !$choices) {
            $attributes  = array_merge($archetype->getAttributes()->toArray(), $attributes);
        }
        foreach ($attributes as $attribute) {
            $attributeWidget = $this->getAttributeWidget($attribute, $archetype);
            $options = array(
                'label' => $attribute->getName(),
            );

            $form = $this->get('form.factory')->createNamed('widgets', 'sylius_product_archetype_attribute_widget', $attributeWidget, $options);
            $forms[$attribute->getId()] = $form->createView();
        }

        return $this->render('FybAttributeBundle::attributeWidgetForms.html.twig', array('forms' => $forms, 'count' => $request->query->get('count')));
    }

    /**
     * @param Attribute $attribute
     * @param Archetype|null $parentArchetype
     * @return AttributeWidget
     */
    private function getAttributeWidget(Attribute $attribute, Archetype $parentArchetype = null)
    {
        $attributeWidget = new AttributeWidget();
        $attributeWidget->setAttribute($attribute);
        $repository = $this->get('fyb.repository.attribte_widget');

        /** @var AttributeWidget $parentAttributeWidget */
        if ($parentAttributeWidget = $repository->getAttributeWidget($attribute, $parentArchetype)) {
            $attributeWidget->setFrontendWidget($parentAttributeWidget->getFrontendWidget());
            $attributeWidget->setBackendWidget($parentAttributeWidget->getBackendWidget());
        } else {
            $attributeWidget->setFrontendWidget($attribute->getFrontendWidget());
            $attributeWidget->setBackendWidget($attribute->getBackendWidget());
        }

        return $attributeWidget;
    }
}
