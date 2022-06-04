<?php

namespace App\Controller;

use App\Entity\SomeM2MEntity;
use App\Form\SomeM2MEntityType;
use App\Repository\SomeM2MEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/some_m2m_entity')]
class SomeM2MEntityController extends AbstractController
{
    #[Route('/', name: 'app_some_m2m_entity_index', methods: ['GET'])]
    public function index(SomeM2MEntityRepository $someM2MEntityRepository): Response
    {
        return $this->render('some_m2m_entity/index.html.twig', [
            'some_m2m_entities' => $someM2MEntityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_some_m2m_entity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SomeM2MEntityRepository $someM2MEntityRepository): Response
    {
        $someM2MEntity = new SomeM2MEntity();
        $form = $this->createForm(SomeM2MEntityType::class, $someM2MEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $someM2MEntityRepository->add($someM2MEntity, true);

            return $this->redirectToRoute('app_some_m2m_entity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('some_m2m_entity/new.html.twig', [
            'some_m2m_entity' => $someM2MEntity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_some_m2m_entity_show', methods: ['GET'])]
    public function show(SomeM2MEntity $someM2MEntity): Response
    {
        return $this->render('some_m2m_entity/show.html.twig', [
            'some_m2m_entity' => $someM2MEntity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_some_m2m_entity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SomeM2MEntity $someM2MEntity, SomeM2MEntityRepository $someM2MEntityRepository): Response
    {
        $form = $this->createForm(SomeM2MEntityType::class, $someM2MEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $someM2MEntityRepository->add($someM2MEntity, true);

            return $this->redirectToRoute('app_some_m2m_entity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('some_m2m_entity/edit.html.twig', [
            'some_m2m_entity' => $someM2MEntity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_some_m2m_entity_delete', methods: ['POST'])]
    public function delete(Request $request, SomeM2MEntity $someM2MEntity, SomeM2MEntityRepository $someM2MEntityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$someM2MEntity->getId(), $request->request->get('_token'))) {
            $someM2MEntityRepository->remove($someM2MEntity, true);
        }

        return $this->redirectToRoute('app_some_m2m_entity_index', [], Response::HTTP_SEE_OTHER);
    }
}
