<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends Controller
{
    /**
    * @Route("/", name="homepage")
    * @Method("GET")
    */
    public function index()
    {
        $number = mt_rand(0, 100);

        return $this->render('home/index.html.twig', ['number' => $number]);
    }
}