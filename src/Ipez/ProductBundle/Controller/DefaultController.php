<?php

namespace Ipez\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('IpezProductBundle:Default:index.html.twig');
    }
    
    public function createAction()
    {
        return $this->render('IpezProductBundle:Default:create.html.twig');
    }
    
    public function readAction()
    {
        return $this->render('IpezProductBundle:Default:read.html.twig');
    }
    
    public function updateAction()
    {
        return $this->render('IpezProductBundle:Default:update.html.twig');
    }
    
    public function deleteAction()
    {
        return $this->render('IpezProductBundle:Default:delete.html.twig');
    }
    
}
