<?php

namespace Ipez\PartyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        } catch (ORM\NoResultException $e) {
            return $this->render('IpezPartyBundle:Default:index.html.twig', array(
                        'parties' => $parties
            ));
        }

        return $this->render('IpezPartyBundle:Default:index.html.twig', array(
                    'parties' => $parties
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
                    $this->get('request')->get('date') !== '')
            {
                $date = explode('/', $this->get('request')->get('date'));
                $get = $date[1].'/'.$date[0].'/'.$date[2];
                
                $party->setName($this->get('request')->get('name'))
                        ->setAddress($this->get('request')->get('address'))
                        ->setTown($this->get('request')->get('town'))
                        ->setCp($this->get('request')->get('cp'))
                        ->setDate(new \DateTime($get));

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

            foreach ($typePartys as $object)
            {
                $em->remove($object);
            }

            $em->remove($party);
            $em->flush();
            
        } catch (ORM\NoResultException $ex) {
            echo "alert('Aucun produit trouvé')";
            return $this->redirect($this->generateUrl('ipez_party_homepage'));
        }

        return $this->redirect($this->generateUrl('ipez_party_homepage'));
    }

}
