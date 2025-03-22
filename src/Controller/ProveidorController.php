<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProveidorController extends AbstractController
{
    /**
     * @Route("/proveidor", name="app_proveidor")
     */
    public function index(): Response
    {
        return $this->render('proveidor/index.html.twig', [
            'controller_name' => 'ProveidorController',
        ]);
    }
}
