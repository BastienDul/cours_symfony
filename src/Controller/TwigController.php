<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwigController extends AbstractController
{
    #[Route('/twig/{nom}', name: 'app_twig')]
    public function index(string $nom = 'Bastien'): Response
    {
        
        $tab = [2, 3, 4];
        return $this->render('twig/index.html.twig', [
            'controller_name' => $nom,
            'tableau'=> $tab,
        ]);
    }
}
