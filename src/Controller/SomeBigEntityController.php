<?php

namespace App\Controller;

use App\Entity\SomeBigEntity;
use App\Form\SomeBigEntityType;
use App\Repository\SomeBigEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/some_big_entity')]
class SomeBigEntityController extends AbstractController
{
    #[Route('/', name: 'app_some_big_entity_index', methods: ['GET'])]
    public function index(SomeBigEntityRepository $someBigEntityRepository): Response
    {
        return $this->render('some_big_entity/index.html.twig', [
            'some_big_entities' => $someBigEntityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_some_big_entity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SomeBigEntityRepository $someBigEntityRepository): Response
    {
        $someBigEntity = new SomeBigEntity();
        $form = $this->createForm(SomeBigEntityType::class, $someBigEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $someBigEntity->setUser($this->getUser());
            $someBigEntity->setCreatedAt(new \DateTimeImmutable());
            $someBigEntityRepository->add($someBigEntity, true);

            return $this->redirectToRoute('app_some_big_entity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('some_big_entity/new.html.twig', [
            'some_big_entity' => $someBigEntity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_some_big_entity_show', methods: ['GET'])]
    public function show(SomeBigEntity $someBigEntity): Response
    {
        return $this->render('some_big_entity/show.html.twig', [
            'some_big_entity' => $someBigEntity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_some_big_entity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SomeBigEntity $someBigEntity, SomeBigEntityRepository $someBigEntityRepository): Response
    {
        $form = $this->createForm(SomeBigEntityType::class, $someBigEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $someBigEntityRepository->add($someBigEntity, true);

            return $this->redirectToRoute('app_some_big_entity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('some_big_entity/edit.html.twig', [
            'some_big_entity' => $someBigEntity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_some_big_entity_delete', methods: ['POST'])]
    public function delete(Request $request, SomeBigEntity $someBigEntity, SomeBigEntityRepository $someBigEntityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$someBigEntity->getId(), $request->request->get('_token'))) {
            $someBigEntityRepository->remove($someBigEntity, true);
        }

        return $this->redirectToRoute('app_some_big_entity_index', [], Response::HTTP_SEE_OTHER);
    }
}
