<?php

namespace Ipez\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        /*$product = new Product();
        $form = $this->createForm(new SurveyType(), $survey);

        $strenghs = $this->getDoctrine()
                ->getRepository('IPMotorsStrenghsBundle:Strenghs')
                ->findAll();


        $emailings = $this->getDoctrine()
                ->getRepository('IPMotorsMailBundle:Mail')
                ->findAll();

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST')
        {
            if ($this->get('request')->get('survey_name') !== null &&
                    $this->get('request')->get('actualVehiculName') !== null &&
                    $this->get('request')->get('futurVehiculName') !== null)
            {

                $actualVehiculStrenghs = implode($this->get('request')->get('actual_strenghs_survey', array()), ':');
                $futurVehiculStrenghs = implode($this->get('request')->get('futur_strenghs_survey', array()), ':');

                $survey->setName($this->get('request')->get('survey_name'))
                        ->setActualVehiculName($this->get('request')->get('actualVehiculName'))
                        ->setActualVehiculStrenghs($actualVehiculStrenghs)
                        ->setFuturVehiculName($this->get('request')->get('futurVehiculName'))
                        ->setFuturVehiculStrenghs($futurVehiculStrenghs)
                        ->setMailId($this->get('request')->get('emailing_survey'))
                        ->setActivated(FALSE)
                        ->setDate(new \DateTime());

                $em = $this->getDoctrine()->getManager();
                $em->persist($survey);
                $em->flush();

                return $this->redirect($this->generateUrl('ip_motors_form_edit_homepage'));
            }
        }

        if (!$survey)
        {
            return $this->redirect($this->generateUrl('ip_motors_form_edit_homepage'));
        }
*/
        return $this->render('IpezProductBundle:Default:create.html.twig', array(
               // 'form' => $form->createView(),
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
