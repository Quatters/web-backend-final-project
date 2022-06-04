<?php

namespace App\Controller;

use App\Entity\SomeType;
use App\Form\SomeTypeType;
use App\Repository\SomeTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/some_type')]
class SomeTypeController extends AbstractController
{
    #[Route('/', name: 'app_some_type_index', methods: ['GET'])]
    public function index(SomeTypeRepository $someTypeRepository): Response
    {
        return $this->render('some_type/index.html.twig', [
            'some_types' => $someTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_some_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SomeTypeRepository $someTypeRepository): Response
    {
        $someType = new SomeType();
        $form = $this->createForm(SomeTypeType::class, $someType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $someTypeRepository->add($someType, true);

            return $this->redirectToRoute('app_some_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('some_type/new.html.twig', [
            'some_type' => $someType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_some_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SomeType $someType, SomeTypeRepository $someTypeRepository): Response
    {
        $form = $this->createForm(SomeTypeType::class, $someType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $someTypeRepository->add($someType, true);

            return $this->redirectToRoute('app_some_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('some_type/edit.html.twig', [
            'some_type' => $someType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_some_type_delete', methods: ['POST'])]
    public function delete(Request $request, SomeType $someType, SomeTypeRepository $someTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$someType->getId(), $request->request->get('_token'))) {
            $someTypeRepository->remove($someType, true);
        }

        return $this->redirectToRoute('app_some_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
