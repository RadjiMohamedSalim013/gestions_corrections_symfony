<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Form\EtablissementType;
use App\Repository\EtablissementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ExportService;


# affichage de la liste des établissements
#[Route('/etablissement')]
final class EtablissementController extends AbstractController
{
    #[Route(name: 'app_etablissement_index', methods: ['GET'])]
    public function index(EtablissementRepository $etablissementRepository): Response
    {
        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissementRepository->findAll(),
        ]);
    }

    # ajout d'un nouvel établissement
    #[Route('/new', name: 'app_etablissement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $etablissement = new Etablissement();
        $form = $this->createForm(EtablissementType::class, $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etablissement);
            $entityManager->flush();
            $this->addFlash('success', 'Établissement créé avec succès.');

            return $this->redirectToRoute('app_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('etablissement/new.html.twig', [
            'etablissement' => $etablissement,
            'form' => $form,
        ]);
    }

    # affichage d'un établissement
    #[Route('/{id}', name: 'app_etablissement_show', methods: ['GET'])]
    public function show(Etablissement $etablissement): Response
    {
        return $this->render('etablissement/show.html.twig', [
            'etablissement' => $etablissement,
        ]);
    }

    # modification d'un établissement
    #[Route('/{id}/edit', name: 'app_etablissement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Etablissement $etablissement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EtablissementType::class, $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('etablissement/edit.html.twig', [
            'etablissement' => $etablissement,
            'form' => $form,
        ]);
    }

    # suppression d'un établissement
    #[Route('/{id}', name: 'app_etablissement_delete', methods: ['POST'])]
    public function delete(Request $request, Etablissement $etablissement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etablissement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($etablissement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_etablissement_index', [], Response::HTTP_SEE_OTHER);
    }

    #export des établissements en cvs, excel et pdf
    #[Route('/etablissement/export/{format}', name: 'app_etablissement_export')]
    public function export(EtablissementRepository $etablissementRepository, ExportService $exportService, string $format): Response
    {

        //recuperation de toutes les données des établissements
        $etablissements = $etablissementRepository->findAll();

         // Transformation des données en tableau associatif
        $data = [];
        foreach ($etablissements as $etablissement) {
            $data[] = [
                'ID' => $etablissement->getId(),
                'Nom' => $etablissement->getNom(),
                'Ville' => $etablissement->getVille(),
            ];
        }

        // retourner en fonction du format demandé
        switch (strtolower($format)) {
            case 'csv':
                $exportService->exportCsv($data, 'etablissements.csv');
                break;
            case 'excel':
                $exportService->exportExcel($data, 'etablissements.xlsx');
                break;
            default:
                throw $this->createNotFoundException('Format non supporté');
        }
        
        
    }
}



       


