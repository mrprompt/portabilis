<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Entity\UserEntity;
use App\Form\LoginForm;
use App\Form\SignupForm;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Register Controller
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class RegisterController extends Controller
{
    /**
     * @Route("/signup", name="signup_post")
     * @Method("POST")
     */
    public function addAction(Request $request, SessionInterface $session, UserService $userService)
    {
        $form = $this->createForm(
            SignupForm::class, 
            new UserEntity(), 
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
            } catch (\Exception $ex) {
                // var_dump($ex);exit;
                $this->addFlash('danger', $ex->getMessage());
            }
        } else {
            if (isset($errors)) {
                foreach ($errors as $error) {
                    $this->addFlash('danger', $error->getMessage());
                }
            }
        }

        return $this->redirect($this->generateUrl('signup'));
    }
}