<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// #[Route('/home')]
class HomeController extends AbstractController
{
    // #[Route('/')]
    #[Route('/home', name:'app_home')]
    public function index( Request $request) : Response
    {
        $prenom = $request->query->all();
        return $this->render('home/index.html.twig', [
            'controller_name' => implode(', ', $prenom),
        ]);
    }

    // ********************** Pour comprendre les priorité ! *****************************************

    // #[Route('/home/index', name:'home_route2', priority: 2)]
    // public function index2() : Response
    // {
    //     return $this->render('home/index.html.twig', [
    //         'controller_name' => "HomeController",
    //     ]);
    // }


}
