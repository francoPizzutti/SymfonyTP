<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    public function home(Session $session)
    {
        if ($this->getUser()!= null) {
            $titulo = 'saca los trapos al sol';
            $load = '';
            return $this->render('home/home.html.twig', [
                'titulo' => $titulo,
                'load' => $load,
            ]);
        }
        else{
            return $this->redirectToRoute('index');
        }
    }
}
