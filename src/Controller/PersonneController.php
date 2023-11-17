<?php

namespace App\Controller;


use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PersonneController extends AbstractController
{
    // #[Route('/personne/add', name: 'app_personne')]
    // public function index(EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    // {
    //     // $entityManager = $doctrine->getManager();
    //     $personne = new Personne();
    //     $personne->setNom('Leclcerc');
    //     $personne->setPrenom('Charlot');
    //     $personne->setSexe('M');
    //     $personne->setAdresses('rue du monaco');
    //     $personne->setNum(16);
    //     $errors = $validator->validate($personne);
    //     if (count($errors) > 0) {
    //         return new Response((string) $errors, 400);
    //     }
    //     $entityManager->persist($personne);
    //     $entityManager->flush();
    //     return $this->render('personne/index.html.twig', [
    //         'controller_name' => 'PersonneController',
    //         'personne' => $personne,
    //         'adjectif' => 'ajoutée'
    //     ]);
    // }

    #[Route('/personne/show', name:'personne_show_all')]
    public function showAllPersonne(PersonneRepository $personneRepository){
        $personnes = $personneRepository->findAll();
        if (!$personnes){
            throw $this->createNotFoundException('La table est vide');
        }
        return $this->render('personne/show.html.twig', [
            'controller_name' => 'PersonneController',
            'personnes'=> $personnes,
        ]);
    } 

    // #[Route('/personne/{id}', name: 'personne_show')]
    // public function showPersonne(int $id, PersonneRepository $personneRepository): Response
    // {
    //     $personne = $personneRepository->find($id);
    //     if (!$personne) {
    //         throw $this->createNotFoundException('Personne non trouvée avec l\'id' . $id);
    //     }
    //     return $this->render('personne/index.html.twig', [
    //         'controller_name' => 'Personne Controller',
    //         'personnes' => $personne,
    //         'adjectif' => 'recherchée'
    //     ]);
    // }

    // #[Route('/personne/{nom}/{prenom}', name: 'personne_show_one')]
    // public function showPersonneByNomAndPrenom(
    //     string $nom,
    //     string $prenom,
    //     PersonneRepository $personneRepository
    // ) {
    //     $personne = $personneRepository->findOneBy([
    //         'nom' => $nom,
    //         'prenom' => $prenom
    //     ]);

    //     if (!$personne) {
    //         throw $this->createNotFoundException('Personne non trouvée');
    //     }
    //     return $this->render('personne/index.html.twig', [
    //         'controller_name' => 'PersonneController',
    //         'personne' => $personne,
    //         'adjectif' => 'recherchée'
    //     ]);
    // }


    #[Route('/personne/edit/{id}', name:'personne_update')]
    public function updatePersonne(int $id, EntityManagerInterface $entityManager){
        $personne = $entityManager->getRepository(Personne::class)->find($id);

        if (!$personne) {
            throw $this->createNotFoundException('Personne non trouvée avec l\'id '. $id);
        }
        $personne->setNom('Potter');
        $entityManager->flush();
        return $this->render('personne/index.html.twig',[
            'controller_name' => 'PeronneController',
            'personne'=> $personne,
            'adjectif' => 'modifiée'
        ]);
    }

    #[Route('/personne/delete/{id}', name:'personne_delete')]
    public function deletePersonne(int $id, EntityManagerInterface $entityManager){
        $personne = $entityManager->getRepository(Personne::class)->find($id);

        if (!$personne) {
            throw $this->createNotFoundException('Personne non trouvée avec l\id'. $id);
        }

        $entityManager->remove($personne);
        $entityManager->flush();
        return $this->redirectToRoute('personne_show_all');
    }
}
