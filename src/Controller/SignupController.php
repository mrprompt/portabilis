<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginForm;
use App\Form\SignupForm;
use App\Service\UserService;
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
            $session->get('signup_data', new User()), 
            ['action' => $this->generateUrl('signup_post')]
        );
        
        $loginForm = $this->createForm(
            LoginForm::class, 
            new User(), 
            ['action' => $this->generateUrl('login_post')]
        );

        return [
            'signupForm' => $signupForm->createView(),
            'loginForm' => $loginForm->createView(),
        ];
    }

    /**
     * @Route("/signup", name="signup_post")
     * @Method("POST")
     * @Template("signup/index.html.twig")
     */
    public function addAction(Request $request, SessionInterface $session, UserService $userService)
    {
        $form = $this->createForm(
            SignupForm::class, 
            new User(), 
            ['action' => $this->generateUrl('signup_post')]
        );
        
        $form->handleRequest($request);
        
        $data = $form->getData();

        $session->set('signup_data', $data);
        
        if ($form->isValid()) {
            try {
                $userService->create($data);

                $this->addFlash('info', 'Registered');
                
                $session->remove('signup_data');
            } catch (\InvalidArgumentException $ex) {
                $this->addFlash('danger', 'Error, this CPF is not valid :(');
            } catch (\Exception $ex) {
                foreach( $errors as $error ) {
                    $this->addFlash('danger', $error->getMessage());
                }
            }
        }

        return $this->redirect($this->generateUrl('signup'));
    }
}