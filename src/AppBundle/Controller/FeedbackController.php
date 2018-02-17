<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Feedback;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Feedback controller.
 *
 */
class FeedbackController extends Controller
{
    /**
     * Lists all feedback entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $feedbacks = $em->getRepository('AppBundle:Feedback')->findAll();

        return $this->render('feedback/index.html.twig', array(
            'feedbacks' => $feedbacks,
        ));
    }

    /**
     * Finds and displays a feedback entity.
     *
     */
    public function showAction(Feedback $feedback)
    {

        return $this->render('feedback/show.html.twig', array(
            'feedback' => $feedback,
        ));
    }
}
