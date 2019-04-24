<?php

namespace Ibtikar\TaniaModelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        
        return $this->render('IbtikarTaniaModelBundle:Default:index.html.twig');
    }

}
