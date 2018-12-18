<?php

namespace App\Controller\Admin;


use App\Entity\Heroes;
use App\Form\HeroType;
use \App\Repository\HeroesRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Routing\Annotation\Route;

class AdminHeroesController extends AbstractController
{

    /**
     * @var HeroesRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * AdminHeroesController constructor.
     * @param HeroesRepository $repository
     * @param ObjectManager $em
     */
    public function __construct(HeroesRepository $repository, ObjectManager $em)
    {

        $this->repository = $repository;
        $this->em = $em;
    }


    /**
     * @Route("/admin", name="admin.hero.index")
     */
    public function index()
    {
        $heroes = $this->repository->findAll();
        return $this->render('admin/heroes/index.html.twig', [
            "heroes" => $heroes
        ]);
    }


    /**
     * @Route("/admin/hero/create", name="admin.hero.new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $hero = new Heroes();
        $form = $this->createForm(HeroType::class, $hero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($hero);
            $this->em->flush();
            $this->addFlash('success', 'Héro créé avec succès');
            return $this->redirectToRoute('admin.hero.index');
        }

        return $this->render('admin/heroes/new.html.twig', [
            "hero" => $hero,
            "form" => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/hero/{id}", name="admin.hero.edit" , methods={"GET|POST"})
     * @param Heroes $hero
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Heroes $hero, Request $request)
    {
        $form = $this->createForm(HeroType::class, $hero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Héro modifié avec succès');
            return $this->redirectToRoute('admin.hero.index');
        }

        return $this->render('admin/heroes/edit.html.twig', [
            "hero" => $hero,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/hero/{id}", name="admin.hero.delete", methods={"DELETE"})
     * @param Heroes $hero
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Heroes $hero, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $hero->getId(), $request->get('_token'))) {
            $this->em->remove($hero);
            $this->em->flush();
            $this->addFlash('success', 'Héro supprimé avec succès');
        }
        return $this->redirectToRoute('admin.hero.index');
    }
}