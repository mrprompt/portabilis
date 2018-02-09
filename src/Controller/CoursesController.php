<?php
declare(strict_types = 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CoursesController extends Controller
{
    /**
     * @Route("/courses", name="courses")
     * @Method("GET")
     * @Template("courses/index.html.twig")
     */
    public function indexAction(SessionInterface $session)
    {
        return [];
    }
}