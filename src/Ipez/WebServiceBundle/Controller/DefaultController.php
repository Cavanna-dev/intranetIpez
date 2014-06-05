<?php

namespace Ipez\WebServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use Ipez\WebServiceBundle\Entity\Newsletter;

class DefaultController extends Controller
{

    public function getDataNewsletterAction()
    {
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST')
        {
            $newsletter = new Newsletter();

            $val = $this->getDoctrine()
                    ->getRepository('IpezWebServiceBundle:Newsletter')
                    ->findBy(array(
                'email' => $request->request->get('email'),
            ));

            /**
             * Déja inscrit à l'enquête
             */
            if (count($val) > 0)
            {

//                $response = new JsonResponse(array(
//                    'error' => 'Vous vous êtes déjà inscrit à la newsletter.'
//                ));
//
//                $response->headers->set('Content-Type', 'application/json');

                return 0;
            }

            try {

                $newsletter->setName($request->request->get('name'))
                           ->setMail($request->request->get('email'));
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($newsletter);
                $em->flush();
        
                $message = array(
                    'success' => "Enregistrement de l'enquête validé."
                );
            } catch (Doctrine\ORM\ORMException $e) {
//                $message = array(
//                    'error' => 'Impossible d\'enregistrer les données. Données doctrine invalides.'
//                );
                
                return 2;
            }
        } else
        {
            $message = array(
                'error' => 'Aucune requete envoyée',
            );
        }
        $response = new JsonResponse($message);

        $response->headers->set('Content-Type', 'application/json');

        return "1";
    }
    
    public function productsDataAction(){
        
        $em             = $this->getDoctrine()->getManager();
        $repoProduct    = $em->getRepository('IpezProductBundle:Product')->findBy(
                array(
                    ));
        
        try {
            $values            = $repoProduct->getCurrent();
            
            $survey = array(
                'name'              => $values->getName(),
                'actualVehiculName' => $values->getActualVehiculName(),
                'strenghsVehicul'   => $strenghsActual,
                'actualFuturName'   => $values->getFuturVehiculName(),
                'strenghsFutur'     => $strenghsFutur
            );
            
        } catch (\Doctrine\ORM\NoResultException $e) {
            $survey = array(
                'error' => 'Not result found !'
            );
        } catch (\Doctrine\ORM\NonUniqueResultException $e) {
            $survey = array(
                'error' => 'Not result found !'
            );
        }
        
        
        
        $response = new JsonResponse($survey);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
        
    }
}
