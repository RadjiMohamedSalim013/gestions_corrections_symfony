<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    # affichage de la page d'accueil
    #[Route('/', name: 'app_home')]
    public function index(): Response
{
    # liste des entités à afficher sur la page d'accueil
    # chaque entité est associée à une route et une icône
    $entities = [
        ['name' => 'Etablissements', 'route' => 'app_etablissement_index', 'icon' => 'building'],
        ['name' => 'Examens', 'route' => 'app_examen_index', 'icon' => 'file-alt'],
        ['name' => 'Epreuves', 'route' => 'app_epreuve_index', 'icon' => 'clipboard'],
        ['name' => 'Professeurs', 'route' => 'app_professeur_index', 'icon' => 'user-tie'],
        ['name' => 'Corrections', 'route' => 'app_correction_index', 'icon' => 'check-circle'],
    ];

    return $this->render('home/index.html.twig', [
        'entities' => $entities,
    ]);
}
}
