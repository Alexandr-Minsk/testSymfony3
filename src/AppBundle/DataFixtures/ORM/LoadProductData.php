<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use \Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categories = $manager->getRepository(Category::class)->findAll(); 

        for ($i=1; $i<=100; $i++ ){
            $category = $categories[mt_rand(0, (count($categories) - 1))];
            $product = new Product();
            $product->setName('Продукт '.$i);
            $product->setSlug('product'.$i);
            $product->setCategory($category);
            $product->setCategorySlug($category->getSlug());
//            $product->setCategoryId($category->getId());
            $product->setDescription('Описание товара    '.$i.'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');
            $product->setImage('images/products/product'.mt_rand(1,25).'.jpg');
            $product->setIntroText(' Краткое описание товара    '.$i.'Lorem Ipsum is simply dummy text of the printing and.');
            $product->setDescription('Описание товара    '.$i.'Lorem Ipsum is simply dummy text of the printing and.');
            $product->setEnabled(true);
            $product->setPrice(mt_rand(1000,100000)*0.01);
            $manager->persist($product);
        }
        
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}