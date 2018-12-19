<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PowerController extends AbstractController
{
    /**
     * @Route("/power", name="power")
     */
    public function index()
    {
        return $this->render('power/index.html.twig', [
            'controller_name' => 'PowerController',
        ]);
    }
}
