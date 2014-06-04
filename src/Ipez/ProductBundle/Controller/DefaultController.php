<?php

namespace Ipez\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ipez\ProductBundle\Entity\Product;
use Ipez\ProductBundle\Entity\Feature;
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

        $types = array();
        try {
            $types = $this->getDoctrine()
                    ->getRepository('IpezProductBundle:Type')
                    ->findAll();
        } catch (ORM\NoResultException $e) {
            return $this->render('IpezProductBundle:Default:create.html.twig', array(
                        'types' => $types
            ));
        }
        
        $request = $this->getRequest();

        if ($request->getMethod() == 'POST')
        {
            if ($this->get('request')->get('reference') !== '' &&
                    $this->get('request')->get('tradeName') !== '' &&
                    $this->get('request')->get('cI') !== '')
            {

                $product->setReference($this->get('request')->get('reference'))
                        ->setTradeName($this->get('request')->get('tradeName'))
                        ->setType($this->get('request')->get('type'))
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
            'types' => $types,
        ));
    }

    public function updateAction($id)
    {
        $types = array();
        try {
            $types = $this->getDoctrine()
                    ->getRepository('IpezProductBundle:Type')
                    ->findAll();
        } catch (ORM\NoResultException $e) {
            return $this->render('IpezProductBundle:Default:update.html.twig', array(
                        'types' => $types
            ));
        }
        
        $product = array();
        try {
            $product = $this->getDoctrine()
                    ->getRepository('IpezProductBundle:Product')
                    ->find($id);
        } catch (ORM\NoResultException $e) {
            return $this->render('IpezProductBundle:Default:update.html.twig', array(
                        'product' => $product
            ));
        }

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            if ($this->get('request')->get('reference') !== '' &&
                    $this->get('request')->get('tradeName') !== '' &&
                    $this->get('request')->get('cI') !== '')
            {

                $product->setReference($this->get('request')->get('reference'))
                        ->setTradeName($this->get('request')->get('tradeName'))
                        ->setType($this->get('request')->get('type'))
                        ->setCI($this->get('request')->get('cI'));

                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirect($this->generateUrl('ipez_product_homepage'));
            }
        }

        return $this->render('IpezProductBundle:Default:update.html.twig', array(
                    'product' => $product, 'types' => $types
        ));
    }

    public function deleteAction($id)
    {
        try {
            $product = $this->getDoctrine()
                    ->getRepository('IpezProductBundle:Product')
                    ->find($id);

            $features = $this->getDoctrine()
                    ->getRepository('IpezProductBundle:Feature')
                    ->findBy(array(
                'productId' => $id
            ));

            $em = $this->getDoctrine()->getManager();

            foreach ($features as $object)
            {
                $em->remove($object);
            }

            $em->remove($product);
            $em->flush();
            
        } catch (ORM\NoResultException $ex) {
            echo "alert('Aucun produit trouvé')";
            return $this->redirect($this->generateUrl('ipez_product_homepage'));
        }

        return $this->redirect($this->generateUrl('ipez_product_homepage'));
    }

    public function addFeatureAction($id)
    {
        $feature = new Feature();

        $product = array();
        $features = array();
        try {
            $product = $this->getDoctrine()
                    ->getRepository('IpezProductBundle:Product')
                    ->find($id);

            $features = $this->getDoctrine()
                    ->getRepository('IpezProductBundle:Feature')
                    ->findAll();
        } catch (ORM\NoResultException $e) {
            return $this->render('IpezProductBundle:Default:index.html.twig', array(
                        'product' => $product,
                        'features' => $features,
            ));
        }

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST')
        {
            if ($this->get('request')->get('featureName') !== '' &&
                    $this->get('request')->get('featureValue') !== '')
            {

                $feature->setNameFeature($this->get('request')->get('featureName'))
                        ->setValue($this->get('request')->get('featureValue'))
                        ->setProductId($id);

                $product->setFeature($feature);

                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->persist($feature);
                $em->flush();

                return $this->render(
                                'IpezProductBundle:Default:add_feature.html.twig', array(
                            'id' => $id,
                            'product' => $product,
                            'features' => $features
                                )
                );
            }
        }

        return $this->render('IpezProductBundle:Default:add_feature.html.twig', array(
                    'product' => $product,
                    'features' => $features
        ));
    }

    public function delFeatureAction($id)
    {
        $feature = new Feature();

        $product = array();
        $features = array();
        try {
            $product = $this->getDoctrine()
                    ->getRepository('IpezProductBundle:Product')
                    ->find($request = $this->getRequest()->get('idProduct'));

            $features = $this->getDoctrine()
                    ->getRepository('IpezProductBundle:Feature')
                    ->findAll();
        } catch (ORM\NoResultException $e) {
            return $this->render('IpezProductBundle:Default:index.html.twig', array(
                        'product' => $product,
                        'features' => $features,
            ));
        }

        try {
            $feature = $this->getDoctrine()
                    ->getRepository('IpezProductBundle:Feature')
                    ->find($id);

            $em = $this->getDoctrine()->getManager();
            $em->remove($feature);
            $em->flush();
        } catch (ORM\NoResultException $ex) {
            echo "alert('Aucune caractéristique trouvée')";
            return $this->render('IpezProductBundle:Default:add_feature.html.twig', array(
                        'id' => $request = $this->getRequest()->get('idProduct'),
                        'product' => $product,
                        'features' => $features
            ));
        }

        return $this->forward('IpezProductBundle:Default:addFeature', array(
                    'id' => $request = $this->getRequest()->get('idProduct'),
                    'product' => $product,
                    'features' => $features
        ));
    }
}
