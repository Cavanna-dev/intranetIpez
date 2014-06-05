<?php

namespace Ipez\CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ipez\CustomerBundle\Entity\Customer;
use Doctrine\ORM;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $customers = array();

        try {
            $customers = $this->getDoctrine()
                    ->getRepository('IpezCustomerBundle:Customer')
                    ->findAll();
        } catch (ORM\NoResultException $e) {
            return $this->render('IpezCustomerBundle:Default:index.html.twig', array(
                        'customers' => $customers
            ));
        }

        $parties = array();
        try {
            $parties = $this->getDoctrine()
                    ->getRepository('IpezPartyBundle:Party')
                    ->findAll();
        } catch (ORM\NoResultException $e) {
            return $this->render('IpezProductBundle:Default:index.html.twig', array(
                        'parties' => $parties
            ));
        }

        return $this->render('IpezCustomerBundle:Default:index.html.twig', array(
                    'customers' => $customers,
                    'parties' => $parties,
        ));
    }

    public function updateAction($id)
    {
        $customer = array();
        try {
            $customer = $this->getDoctrine()
                    ->getRepository('IpezCustomerBundle:Customer')
                    ->find($id);
        } catch (ORM\NoResultException $e) {
            return $this->render('IpezCustomerBundle:Default:update.html.twig', array(
                        'customer' => $customer
            ));
        }

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            if ($this->get('request')->get('name') !== '' &&
                    $this->get('request')->get('firstName') !== '' &&
                    $this->get('request')->get('mail') !== '' &&
                    $this->get('request')->get('number') !== '' &&
                    $this->get('request')->get('numberGsm') !== '' &&
                    $this->get('request')->get('address') !== '' &&
                    $this->get('request')->get('town') !== '' &&
                    $this->get('request')->get('cp') !== '' &&
                    $this->get('request')->get('dateBirth') !== '' &&
                    $this->get('request')->get('isActive') !== '')
            {
                $date = explode('/', $this->get('request')->get('dateBirth'));
                $get = $date[1] . '/' . $date[0] . '/' . $date[2];

                $customer->setName($this->get('request')->get('name'))
                        ->setFirstName($this->get('request')->get('firstName'))
                        ->setMail($this->get('request')->get('mail'))
                        ->setNumber($this->get('request')->get('number'))
                        ->setNumberGsm($this->get('request')->get('numberGsm'))
                        ->setAddress($this->get('request')->get('address'))
                        ->setTown($this->get('request')->get('town'))
                        ->setCp($this->get('request')->get('cp'))
                        ->setDateBirth(new \DateTime($get))
                        ->setIsActive($this->get('request')->get('isActive'));

                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirect($this->generateUrl('ipez_customer_homepage'));
            }
        }

        return $this->render('IpezCustomerBundle:Default:update.html.twig', array(
                    'customer' => $customer
        ));
    }

    public function deleteAction($id)
    {
        try {
            $customer = $customers = $this->getDoctrine()
                    ->getRepository('IpezCustomerBundle:Customer')
                    ->find($id);

            $em = $this->getDoctrine()->getManager();
            $em->remove($customer);
            $em->flush();
        } catch (ORM\NoResultException $ex) {
            echo "alert('Aucun client trouvé')";
            return $this->redirect($this->generateUrl('ipez_customer_homepage'));
        }

        return $this->redirect($this->generateUrl('ipez_customer_homepage'));
    }

    public function exportAction()
    {
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            if ($this->get('request')->get('partyId') !== '')
            {
                $party = array();
                try {
                    $party = $this->getDoctrine()
                            ->getRepository('IpezPartyBundle:Party')
                            ->findOneBy(
                            array(
                                'id' => $this->get('request')->get('partyId'),
                    ));
                } catch (\Doctrine\ORM\NoResultException $ex) {
                    return new \Symfony\Component\HttpFoundation\JsonResponse(array(
                        'error' => 'Aucune soirée selectionnée.',
                    ));
                }

                $participations = array();
                try {
                    $participations = $this->getDoctrine()
                            ->getRepository('IpezPartyBundle:Participation')
                            ->findBy(
                            array(
                                'partyId' => 2,
                    ));
                } catch (Exception $ex) {
                    return new \Symfony\Component\HttpFoundation\JsonResponse(array(
                        'error' => 'Aucun Client pour cet evenement.',
                    ));
                }

                foreach ($participations as $object)
                {
                    $user = $this->getDoctrine()
                            ->getRepository('IpezCustomerBundle:Customer')
                            ->findOneBy(
                            array(
                                'id' => '1',
                    ));

                    var_dump($user);
                    die;

                    $usersExport = array();
                    $usersExport[$user->getId()] = $user->getMail();
                }

                $custoRepo = $this->getDoctrine()
                        ->getRepository('IpezCustomerBundle:Customer');

                $handle = fopen('php://memory', 'r+');

                foreach ($usersExport as $answer)
                {
                    fputcsv($handle, array($answer));
                }

                rewind($handle);
                $content = stream_get_contents($handle);
                fclose($handle);

                return new \Symfony\Component\HttpFoundation\Response($content, 200, array(
                    'Content-Type' => 'application/force-download',
                    'Content-Disposition' => 'attachment; filename="export.csv"'
                ));
            }
        }
    }

}
