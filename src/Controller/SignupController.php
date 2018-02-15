<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Entity\UserEntity;
use App\Form\LoginForm;
use App\Form\SignupForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SignupController extends Controller
{
    /**
     * @Route("/signup", name="signup")
     * @Method("GET")
     * @Template("signup/index.html.twig")
     */
    public function indexAction(SessionInterface $session)
    {
        if ($session->get('user') !== null) {
            return $this->redirect($this->generateUrl('homepage')); 
        }
        
        $signupForm = $this->createForm(
            SignupForm::class, 
            $session->get('signup_data', new UserEntity()), 
            ['action' => $this->generateUrl('signup_post')]
        );
        
        $loginForm = $this->createForm(
            LoginForm::class, 
            new UserEntity(), 
            ['action' => $this->generateUrl('login_post')]
        );

        return [
            'signupForm' => $signupForm->createView(),
            'loginForm' => $loginForm->createView(),
        ];
    }
}