<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * @Route("/loginn", name="loginn")
     */
    public function loginAction(Request $request)
    {
        return new Response('<h1>cokoferopfrepfrepfnrep</h1>');
    }
}
