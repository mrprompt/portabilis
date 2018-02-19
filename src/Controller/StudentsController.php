<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Students Controller
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class StudentsController extends Controller
{
    /**
     * @Route("/students", name="students")
     * @Method("GET")
     * @Template("students/index.html.twig")
     */
    public function indexAction(SessionInterface $session, UserService $userService)
    {
        $students = $userService->findAll();

        return ['students' => $students];
    }
}