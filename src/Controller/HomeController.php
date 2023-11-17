<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Personne;

// #[Route('/home')]
class HomeController extends AbstractController
{
    // #[Route("/index", name:"index_route", methods: ["GET", "POST"])]
    #[Route('/home/', name:'app_home')]
    public function index() : Response
    {
        $personne = new Personne();
        $personne->setNom('Duliege');
        $personne->setPrenom('Bastien');
        $tab = [1,2,3];
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'tableau'=> $tab,
            'personne'=> $personne

        ]);
    }

    #[Route('/menu', name:'menu_route')]
    public function menu() : Response{
        return $this->render('shared/_menu.twig', []);
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
