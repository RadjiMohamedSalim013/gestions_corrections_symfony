<?php

namespace App\Controller;

use App\Entity\Correction;
use App\Form\CorrectionType;
use App\Repository\CorrectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/correction')]
final class CorrectionController extends AbstractController
{
    #[Route(name: 'app_correction_index', methods: ['GET'])]
    public function index(CorrectionRepository $correctionRepository): Response
    {
        return $this->render('correction/index.html.twig', [
            'corrections' => $correctionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_correction_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $correction = new Correction();
        $form = $this->createForm(CorrectionType::class, $correction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($correction);
            $entityManager->flush();

            return $this->redirectToRoute('app_correction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('correction/new.html.twig', [
            'correction' => $correction,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_correction_show', methods: ['GET'])]
    public function show(Correction $correction): Response
    {
        return $this->render('correction/show.html.twig', [
            'correction' => $correction,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_correction_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Correction $correction, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CorrectionType::class, $correction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_correction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('correction/edit.html.twig', [
            'correction' => $correction,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_correction_delete', methods: ['POST'])]
    public function delete(Request $request, Correction $correction, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$correction->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($correction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_correction_index', [], Response::HTTP_SEE_OTHER);
    }
}
