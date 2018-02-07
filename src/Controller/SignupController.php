<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\LoginForm;
use App\Form\SignupForm;
use App\Service\Password;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
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
    public function indexAction()
    {
        $signupForm = $this->createForm(SignupForm::class, new User(), ['action' => $this->generateUrl('signup_post')]);
        $loginForm = $this->createForm(LoginForm::class, new User(), ['action' => $this->generateUrl('login_post')]);

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
    public function addAction(Request $request, Password $passwdService)
    {
        $form = $this->createForm(
            SignupForm::class, 
            new User(), 
            ['action' => $this->generateUrl('signup_post')]
        );
        $form->handleRequest($request);
        
        $data = $form->getData();

        if ($form->isValid()) {
            $data->setPassword($passwdService->generate($data->getPassword(), 12));

            $this->addFlash('info', 'Registered');
        } else {
            $errors = $form->getErrors(true, true);

            foreach( $errors as $error ) {
                $this->addFlash('danger', $error->getMessage());
            }
        }

        return $this->redirect($this->generateUrl('signup'));
    }
}
