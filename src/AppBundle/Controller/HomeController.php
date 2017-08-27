<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Feedback;
use AppBundle\Entity\Product;
use AppBundle\Form\FeedbackType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $popularCategories = $em->getRepository(Category::class)->findBy([], [], 3, rand(0,6));
        $specialProducts = $em->getRepository(Product::class)->findBy([], [], 12, rand(0,88));
        return $this->render('AppBundle:Home:index.html.twig', array(
            'popularCategories' => $popularCategories,
            'specialProducts' => $specialProducts,
            'page' => 'home'
        ));
    }
    
    public function contactsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $feedback = new Feedback();
        $feedbackForm = $this->createForm(FeedbackType::class, $feedback);
        if ($request->isMethod($request::METHOD_POST)){
            $feedbackForm->handleRequest($request);
            $em->persist($feedback);
            $em->flush();
            return $this->render('AppBundle:Home:feedbackSuccess.html.twig', array(
                'page' => 'contacts'
            ));
        }

        return $this->render('AppBundle:Home:contacts.html.twig', array(
            'feedbackForm' => $feedbackForm->createView(),
            'page' => 'contacts'
        ));
    }
    
    

}
