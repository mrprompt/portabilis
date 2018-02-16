<?php
declare(strict_types = 1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Default controller
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
class DefaultController extends Controller
{
    /**
    * @Route("/", name="homepage")
    * @Method("GET")
    * @Template("home/index.html.twig")
    */
    public function index(): array
    {
        return [];
    }
}