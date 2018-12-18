<?php

namespace App\Controller;

use App\Repository\HeroesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @param HeroesRepository $repository
     * @return Response
     */
    public function index (HeroesRepository $repository): Response {
        $heroes = $repository->findAll();
        return $this->render('main/home.html.twig', [
            "heroes" => $heroes
        ]);
    }
}