<?php

namespace Fyb\Bundle\CoreBundle\Controller;

use Fyb\Component\Core\Model\Product;
use Sylius\Bundle\CoreBundle\Controller\ProductController as BaseProductController;
use Sylius\Component\Core\Model\TaxonInterface;
use Symfony\Component\HttpFoundation\Request;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends BaseProductController
{
    /**
     * {@inheritdoc}
     */
    public function indexByTaxonIdAndStoreAction(Request $request, $id)
    {
        $taxon = $this->get('sylius.repository.taxon')->find($id);

        if (!isset($taxon)) {
            throw new NotFoundHttpException('Requested taxon does not exist.');
        }

        $paginator = $this
            ->getRepository()
            ->createByTaxonAndStorePaginator($taxon, $this->getUser()->getStore())
        ;

        return $this->renderResults($taxon, $paginator, 'productIndex.html', $request->get('page', 1));
    }


    /**
     * {@inheritdoc}
     */
    public function createNew()
    {
        /** @var Product $product */
        $product = parent::createNew();

        if ($user = $this->getUser()) {
            $product->setStore($user->getStore());
        }

        $taxonId = $this->get('request_stack')->getCurrentRequest()->query->get('taxonId');

        if ($taxon = $this->get('sylius.repository.taxon')->find($taxonId)) {
            $product->setMainTaxon($taxon);
            $product->addTaxon($taxon);
        }

        return $product;
    }

    /**
     * {@inheritdoc}
     */
    protected function isGrantedOr403($permission)
    {
        $result = $this->config->getPermission($permission);

        if ($result && $this->get('sylius.authorization_checker')->isGranted(sprintf('fyb.listing.%s', $result))) {
                return true;
        }

        return parent::isGrantedOr403($permission);
    }

    /**
     * @param TaxonInterface $taxon
     * @param Pagerfanta $results
     * @param $template
     * @param $page
     * @param null $facets
     * @param null $facetTags
     * @param null $filters
     * @param null $searchTerm
     * @param null $searchParam
     * @param null $requestMethod
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function renderResults(
        TaxonInterface $taxon,
        Pagerfanta $results,
        $template,
        $page,
        $facets = null,
        $facetTags = null,
        $filters = null,
        $searchTerm = null,
        $searchParam = null,
        $requestMethod = null
    ) {
        $results->setCurrentPage($page, true, true);
        $results->setMaxPerPage($this->config->getPaginationMaxPerPage());

        $view = $this
            ->view()
            ->setTemplate($this->config->getTemplate($template))
            ->setData(array(
                'taxon'    => $taxon,
                'products' => $results,
                'facets'   => $facets,
                'facetTags' => $facetTags,
                'filters' => $filters,
                'searchTerm' => $searchTerm,
                'searchParam' => $searchParam,
                'requestMethod' => $requestMethod,
            ))
        ;

        return $this->handleView($view);
    }
}
