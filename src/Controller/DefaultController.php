<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class DefaultController extends Controller {

    /**
     * @Route("/", name="root")
     */
    function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'title' => 'Eagle Chat Bot'
        ]);
    }



}
