<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $session = new Session();
        $messages = $session->getFlashBag()->get('error', array());
        $userId = $session->get('user_id', 0);
        $name = null;

        if ($userId) {
            $repository = $this->getDoctrine()->getRepository(Users::class);
            $user = $repository->find($userId);
            if ($user) {
                $name = $user->getName();
            }
        }

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'messages' => $messages,
            'name'     => $name,
        ));
    }
}
