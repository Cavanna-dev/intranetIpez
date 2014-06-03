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

        return $this->render('IpezCustomerBundle:Default:index.html.twig', array(
                'customers' => $customers
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
            if ($this->get('request')->get('name') !== null &&
                    $this->get('request')->get('firstName') !== null &&
                    $this->get('request')->get('mail') !== null &&
                    $this->get('request')->get('number') !== null &&
                    $this->get('request')->get('numberGsm') !== null &&
                    $this->get('request')->get('address') !== null &&
                    $this->get('request')->get('town') !== null &&
                    $this->get('request')->get('cp') !== null &&
                    $this->get('request')->get('dateBirth') !== null &&
                    $this->get('request')->get('isActive') !== null)
            {
                $date = explode('/', $this->get('request')->get('dateBirth'));
                $get = $date[1].'/'.$date[0].'/'.$date[2];

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
}
