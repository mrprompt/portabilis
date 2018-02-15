<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Entity\UserEntity;
use App\Form\ProfileForm;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ProfileController extends Controller
{
    /**
     * @Route("/profile", name="profile")
     * @Method("GET")
     * @Template("profile/index.html.twig")
     */
    public function indexAction(SessionInterface $session)
    {
        if ($session->get('user') === null) {
            return $this->redirect($this->generateUrl('homepage')); 
        }
        
        $signupForm = $this->createForm(
            ProfileForm::class, 
            $session->get('user'), 
            ['action' => $this->generateUrl('profile_post')]
        );
        
        return ['signupForm' => $signupForm->createView()];
    }

    /**
     * @Route("/profile", name="profile_post")
     * @Method("POST")
     */
    public function addAction(Request $request, SessionInterface $session, UserService $userService)
    {
        if ($session->get('user') === null) {
            return $this->redirect($this->generateUrl('homepage')); 
        }

        $form = $this->createForm(
            ProfileForm::class, 
            $session->get('user'), 
            ['action' => $this->generateUrl('profile_post')]
        );
        
        $form->handleRequest($request);
        
        $data = $form->getData();

        if ($form->isValid()) {
            try {
                // $userService->update($data);

                $this->addFlash('info', 'Updated');
            } catch (\Exception $ex) {
                $this->addFlash('danger', $ex->getMessage());
            }
        } else {
            $this->addFlash('danger', 'Error updating profile');

            foreach ($form->getErrors() as $error) {
                $this->addFlash('danger', $error->getMessage());
            }
        }

        return $this->redirect($this->generateUrl('profile'));
    }
}