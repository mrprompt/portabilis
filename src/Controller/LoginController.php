<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginForm;
use App\Form\SignupForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login_post")
     * @Method("POST")
     * @Template("signup/index.html.twig", vars={"post"})
     */
    public function loginAction()
    {
        $this->addFlash('info', 'Logged');

        return $this->redirect($this->generateUrl('signup'));
    }
}
