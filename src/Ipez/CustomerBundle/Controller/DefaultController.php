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
    
        public function updateAction()
    {
        return $this->render('IpezProductBundle:Default:update.html.twig');
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
