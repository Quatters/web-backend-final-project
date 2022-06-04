<?php

namespace App\Controller;

use App\Entity\ImageEntity;
use App\Form\ImageEntityType;
use App\Repository\ImageEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/images')]
class ImageEntityController extends AbstractController
{
    #[Route('/', name: 'app_image_entity_index', methods: ['GET'])]
    public function index(ImageEntityRepository $imageEntityRepository): Response
    {
        return $this->render('image_entity/index.html.twig', [
            'images' => $imageEntityRepository->findBy(array(), array('id' => 'DESC')),
        ]);
    }

    #[Route('/new', name: 'app_image_entity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ImageEntityRepository $imageEntityRepository,
                        SluggerInterface $slugger): Response
    {
        $imageEntity = new ImageEntity();
        $form = $this->createForm(ImageEntityType::class, $imageEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('file')->getData();
            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
                $file->move(
                    'images',
                    $newFilename
                );
                $imageEntity->setFilename($newFilename);
                $imageEntityRepository->add($imageEntity, true);
            }

            return $this->redirectToRoute('app_image_entity_index');
        }

        return $this->renderForm('image_entity/new.html.twig', [
            'form' => $form,
        ]);
    }
}