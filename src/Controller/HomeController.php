<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return new Response
        (
        $this->renderView("Components/header.twig")
            .
        $this->renderView('home/home.twig')
        );
}
    #[Route('/nav', name: 'nav_bar')]
    public function nav_bar(): Response
    {
        return new Response
        (
        $this->renderView("Components/header.twig")
        );
    }
}
