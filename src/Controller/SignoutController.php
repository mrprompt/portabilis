<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SignoutController extends Controller
{
    /**
     * @Route("/logout", name="signout")
     * @Method("GET")
     */
    public function indexAction(SessionInterface $session)
    {
        $session->clear();

        return $this->redirect($this->generateUrl('homepage')); 
    }
}
