<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Entity\UserEntity;
use App\Form\LoginForm;
use App\Service\AuthorizationService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login_post")
     * @Method("POST")
     * @Template("signup/index.html.twig", vars={"post"})
     */
    public function loginAction(Request $request, SessionInterface $session, AuthorizationService $auth)
    {
        $form = $this->createForm(
            LoginForm::class, 
            new UserEntity(), 
            ['action' => $this->generateUrl('login_post')]
        );
        
        $form->handleRequest($request);
        
        $data = $form->getData();

        if ($form->isSubmitted()) {
            try {
                $authorized = $auth->authorize($data);
                
                $session->set('user', $authorized);
                
                $this->addFlash('info', 'User logged');
                
                return $this->redirect($this->generateUrl('homepage'));
            } catch (\InvalidArgumentException $ex) {
                $this->addFlash('danger', 'Not authorized');
            }
        } else {
            $errors = $form->getErrors(true, true);

            foreach ($errors as $error) {
                $this->addFlash('danger', $error->getMessage());
            }
        }

        return $this->redirect($this->generateUrl('signup'));
    }
}
