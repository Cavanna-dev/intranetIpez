<?php

namespace Ipez\PartyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM;
use Ipez\PartyBundle\Entity\Party;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $parties = array();
        try {
            $parties = $this->getDoctrine()
                    ->getRepository('IpezPartyBundle:Party')
                    ->findAll();

            $participation = $this->getDoctrine()
                    ->getRepository('IpezPartyBundle:Participation')
                    ->findAll();
        } catch (ORM\NoResultException $e) {
            return $this->render('IpezPartyBundle:Default:index.html.twig', array(
                    'parties' => $parties
            ));
        }

        return $this->render('IpezPartyBundle:Default:index.html.twig', array(
                'parties' => $parties,
                'participation' => $participation,
        ));
    }

    public function createAction()
    {
        $party = new Party();


        $request = $this->getRequest();

        if ($request->getMethod() == 'POST')
        {
            if ($this->get('request')->get('name') !== '' &&
                    $this->get('request')->get('address') !== '' &&
                    $this->get('request')->get('cp') !== '' &&
                    $this->get('request')->get('town') !== '' &&
                    $this->get('request')->get('nbParticipant') !== '' &&
                    $this->get('request')->get('isActive') !== '' &&
                    $this->get('request')->get('date') !== '')
            {
                // $date = explode('/', $this->get('request')->get('date'));
                // $get = $date[1] . '/' . $date[0] . '/' . $date[2];

                $party->setName($this->get('request')->get('name'))
                        ->setAddress($this->get('request')->get('address'))
                        ->setTown($this->get('request')->get('town'))
                        ->setNbParticipant($this->get('request')->get('nbParticipant'))
                        ->setIsActive($this->get('request')->get('isActive'))
                        ->setCp($this->get('request')->get('cp'))
                        ->setDate(new \DateTime($this->get('request')->get('date')));

                $em = $this->getDoctrine()->getManager();
                $em->persist($party);
                $em->flush();

                return $this->redirect($this->generateUrl('ipez_party_homepage'));
            }
        }

        if (!$party)
        {
            return $this->redirect($this->generateUrl('ipez_party_homepage'));
        }

        return $this->render('IpezPartyBundle:Default:create.html.twig', array());
    }

    public function deleteAction($id)
    {
        try {
            $party = $this->getDoctrine()
                    ->getRepository('IpezPartyBundle:Party')
                    ->find($id);

            $typePartys = $this->getDoctrine()
                    ->getRepository('IpezPartyBundle:TypeParty')
                    ->findBy(array(
            'partyId' => $id
            ));

            $em = $this->getDoctrine()->getManager();

            foreach ($typePartys as $object) {
                $em->remove($object);
            }

            $em->remove($party);
            $em->flush();
        } catch (ORM\NoResultException $ex) {
            echo "alert('Aucun evenement trouvé')";
            return $this->redirect($this->generateUrl('ipez_party_homepage'));
        }

        return $this->redirect($this->generateUrl('ipez_party_homepage'));
    }

    public function updateAction($id)
    {
        $party = array();
        try {
            $party = $this->getDoctrine()
                    ->getRepository('IpezPartyBundle:Party')
                    ->find($id);
        } catch (ORM\NoResultException $e) {
            return $this->render('IpezPartyBundle:Default:update.html.twig', array(
                        'party' => $party
            ));
        }

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            if ($this->get('request')->get('name') !== '' &&
                    $this->get('request')->get('address') !== '' &&
                    $this->get('request')->get('town') !== '' &&
                    $this->get('request')->get('cp') !== '' &&
                    $this->get('request')->get('nbParticipant') !== '' &&
                    $this->get('request')->get('isActive') !== '' &&
                    $this->get('request')->get('date') !== '')
            {
                $date = explode('/', $this->get('request')->get('date'));
                $get = $date[1].'/'.$date[0].'/'.$date[2];

                $party->setName($this->get('request')->get('name'))
                        ->setAddress($this->get('request')->get('address'))
                        ->setTown($this->get('request')->get('town'))
                        ->setNbParticipant($this->get('request')->get('nbParticipant'))
                        ->setIsActive($this->get('request')->get('isActive'))
                        ->setCp($this->get('request')->get('cp'))
                        ->setDate(new \DateTime($get));

                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirect($this->generateUrl('ipez_party_homepage'));
            }
        }

        return $this->render('IpezPartyBundle:Default:update.html.twig', array(
                    'party' => $party
        ));
    }
    
    public function sendConfirmationPartyAction($partyId)
    {
        try {
            $participations = $this->getDoctrine()
                    ->getRepository('IpezPartyBundle:Participation')
                    ->findBy(array(
            'partyId' => $partyId,
            'confirm' => 0
            ));
            $party = $this->getDoctrine()
                    ->getRepository('IpezPartyBundle:Party')
                    ->find(array(
            'id' => $partyId
            ));

            foreach ($participations as $value) {
                $user = $this->getDoctrine()
                        ->getRepository('IpezCustomerBundle:Customer')
                        ->find(array(
                'id' => $value->getUserId()
                ));

                $message = \Swift_Message::newInstance()
                        ->setSubject('Confirmation Inscription Evenement : ' . $party->getName())
                        ->setFrom('cavannachristophe@gmail.com')
                        ->setTo($user->getMail())
                        ->setBody('Confirmer votre inscription ici => : http://localhost/intranetIpez/web/app_dev.php/party/confirmed/'.$party->getId().'/'.$user->getId())
                ;
                $this->get('mailer')->send($message);
            
            $value->setDateInvit(new \DateTime());
            
            }
        } catch (ORM\NoResultException $ex) {
            echo "alert('Aucun produit trouvé')";
            return $this->redirect($this->generateUrl('ipez_party_homepage'));
        }

        return $this->redirect($this->generateUrl('ipez_party_homepage'));
    }

    public function userConfirmPartyAction($partyId, $userId)
    {
        $participation = array();
        try {
            $participation = $this->getDoctrine()
                    ->getRepository('IpezPartyBundle:Participation')
                    ->findOneBy(array(
            'partyId' => $partyId,
            'userId' => $userId
            ));
            
            $participation->setConfirm(1);
            $participation->setDateConfirm(new \DateTime());
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($participation);
            $em->flush();
            
        } catch (ORM\NoResultException $ex) {
            echo "alert('Aucun produit trouvé')";
            return $this->redirect($this->generateUrl('ipez_party_homepage'));
        }
        
        return $this->redirect($this->generateUrl('ipez_party_homepage'));
    }

}
