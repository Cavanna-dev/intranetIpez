<?php

namespace Ipez\PartyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $parties = array();
        try {
            $parties = $this->getDoctrine()
                    ->getRepository('IpezPartyBundle:Party')
                    ->findAll();
        } catch (ORM\NoResultException $e) {
            return $this->render('IpezPartyBundle:Default:index.html.twig', array(
                        'parties' => $parties
            ));
        }

        return $this->render('IpezPartyBundle:Default:index.html.twig', array(
                    'parties' => $parties
        ));
    }

}
