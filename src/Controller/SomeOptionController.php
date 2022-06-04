<?php

namespace App\Controller;

use App\Entity\SomeOption;
use App\Form\SomeOptionType;
use App\Repository\SomeOptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/some_option')]
class SomeOptionController extends AbstractController
{
    #[Route('/', name: 'app_some_option_index', methods: ['GET'])]
    public function index(SomeOptionRepository $someOptionRepository): Response
    {
        return $this->render('some_option/index.html.twig', [
            'some_options' => $someOptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_some_option_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SomeOptionRepository $someOptionRepository): Response
    {
        $someOption = new SomeOption();
        $form = $this->createForm(SomeOptionType::class, $someOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $someOptionRepository->add($someOption, true);

            return $this->redirectToRoute('app_some_option_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('some_option/new.html.twig', [
            'some_option' => $someOption,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_some_option_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SomeOption $someOption, SomeOptionRepository $someOptionRepository): Response
    {
        $form = $this->createForm(SomeOptionType::class, $someOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $someOptionRepository->add($someOption, true);

            return $this->redirectToRoute('app_some_option_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('some_option/edit.html.twig', [
            'some_option' => $someOption,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_some_option_delete', methods: ['POST'])]
    public function delete(Request $request, SomeOption $someOption, SomeOptionRepository $someOptionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$someOption->getId(), $request->request->get('_token'))) {
            $someOptionRepository->remove($someOption, true);
        }

        return $this->redirectToRoute('app_some_option_index', [], Response::HTTP_SEE_OTHER);
    }
}
