<?php

namespace Urbanparking\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/login", name="login")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        $session = new Session();

        $messages = $session->getFlashBag()->get('error', array());

        return $this->render('UserBundle:Default:login.html.twig', array(
            'messages' => $messages
        ));
    }

    /**
     * @Route("/login")
     * @Method({"POST"})
     */
    public function loginAction(Request $request)
    {
        $session = new Session();

        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $repository = $this->getDoctrine()->getRepository(Users::class);
        $user = $repository->findOneByEmail($email);

        if ($user && $password === $user->getPassword()) {
            $session->set('user_id', $user->getId());
            return $this->redirectToRoute('homepage');
        }

        $session->getFlashBag()->add('error', 'Invalid email or password!');
        return $this->redirectToRoute('login');
    }

    /**
     * @Route("/logout")
     */
    public function logoutAction()
    {
        $session = new Session();
        $session->remove('user_id');

        return $this->redirectToRoute('homepage');
    }
}
