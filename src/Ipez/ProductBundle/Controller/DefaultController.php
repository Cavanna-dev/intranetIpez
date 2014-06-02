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
}
