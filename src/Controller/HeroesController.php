<?php

namespace App\Controller;

use App\Entity\Heroes;
use App\Repository\HeroesRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Routing\Annotation\Route;

class HeroesController extends AbstractController
{

    /**
     * @var HeroesRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(HeroesRepository $repository, ObjectManager $manager)
    {

        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/heroes_creator", name="heroes.create")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('heroes/index.html.twig', [
            'current_menu' => 'create'
        ]);
    }

    /**
     * @Route("/heroes/{slug}-{id}", name="hero.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Heroes $hero
     * @return Response
     */
    public function show(Heroes $heroes, string $slug): Response
    {
        if ($heroes->getSlug() !== $slug)
            return $this->redirectToRoute('hero.show', [
                'id' => $heroes->getId(),
                'slug' => $heroes->getSlug()
            ], 301);
        return $this->render('heroes/show.html.twig', [
            'hero'         => $heroes,
            'current_menu' => 'create'
        ]);
    }
}
