<?php

namespace Ipez\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ipez\ProductBundle\Entity\Product;

use Doctrine\ORM;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $products = array();

        try {
            $products = $this->getDoctrine()
                             ->getRepository('IpezProductBundle:Product')
                             ->findAll();
        } catch (ORM\NoResultException $e) {
            return $this->render('IpezProductBundle:Default:index.html.twig', array(
                    'products' => $products
            ));
        }

        return $this->render('IpezProductBundle:Default:index.html.twig', array(
                'products' => $products
        ));
    }

    public function createAction()
    {
        $product = new Product();

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST')
        {
            if ($this->get('request')->get('reference') !== null &&
                    $this->get('request')->get('tradeName') !== null &&
                    $this->get('request')->get('cI') !== null)
            {

                $productCaract = implode($this->get('request')->get('productCaract', array()), ':');
               
                $product->setReference($this->get('request')->get('reference'))
                        ->setTradeName($this->get('request')->get('tradeName'))
                        ->setCI($this->get('request')->get('cI'));

                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();

                return $this->redirect($this->generateUrl('ipez_product_homepage'));
            }
        }

        if (!$product)
        {
            return $this->redirect($this->generateUrl('ipez_product_homepage'));
        }
        
        return $this->render('IpezProductBundle:Default:create.html.twig', array(
        ));
    }

    public function readAction()
    {
        return $this->render('IpezProductBundle:Default:read.html.twig');
    }

    public function updateAction()
    {
        return $this->render('IpezProductBundle:Default:update.html.twig');
    }

    public function deleteAction($id)
    {
        try {
            $product = $products = $this->getDoctrine()
                                    ->getRepository('IpezProductBundle:Product')
                                    ->find($id);
            
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();
        
        } catch (ORM\NoResultException $ex) {
            echo "alert('Aucun produit trouvé')";
            return $this->redirect($this->generateUrl('ipez_product_homepage'));
        }
        
        return $this->redirect($this->generateUrl('ipez_product_homepage'));
    }

}
