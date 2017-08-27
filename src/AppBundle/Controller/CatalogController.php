<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CatalogController extends Controller
{
    
    public function catalogAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render('AppBundle:Catalog:catalog.html.twig', array(
            'categories' =>$categories,
            'page' => 'catalog'
        ));
    }

    public function categoryAction($categorySlug)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)->findOneBySlug($categorySlug);
        $products = $em->getRepository(Product::class)->findBy([
            'categoryId' => $category->getId(),
            'enabled' => true
        ]);
        return $this->render('AppBundle:Catalog:category.html.twig', array(
            'category' => $category,
            'products' => $products,
            'page' => 'catalog'
        ));
    }

    public function productAction($categorySlug, $productSlug)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)->findOneBySlug($categorySlug);
        $product = $em->getRepository(Product::class)->findOneBySlug( str_replace('.html', '', $productSlug));

        return $this->render('AppBundle:Catalog:product.html.twig', array(
            'category' => $category,
            'product' => $product,
            'page' => 'catalog'
        ));
    }

}
