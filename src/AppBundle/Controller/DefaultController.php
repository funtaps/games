<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Meeting;
use AppBundle\Repository\MeetingRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
    /**
     * @Route("/s", name="homepage")
     */
    public function indexAction()
    {
        $m = new Meeting();
        $m->setDate(new \DateTime());
        $em = $this->getDoctrine()->getManager();
        $em->persist($m);
        $em->flush();
        $mr = $this->getDoctrine()->getRepository('AppBundle:Meeting');
        /**
         * @var MeetingRepository $mr
         */
        $last = $mr->findOneById($m->getId() - 1);
        /**
         * @var Meeting $last
         */
        return $this->render('default/simpliest.html.twig', array(
            'result' => $last->getDate()->format('Y-m-d H:i:s'),
        ));
    }
}
