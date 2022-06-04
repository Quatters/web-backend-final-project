<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route(['/', 'index', '/index.php', 'home'], name: 'home')]
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'tasks' => [
                [
                    'name' => 'connect sqlite for local development',
                    'completed' => true,
                ],
                [
                    'name' => 'use mysql for remote server (env vars/config file)',
                    'completed' => true,
                ],
                [
                    'name' => 'create user entity',
                    'completed' => true,
                ],
                [
                    'name' => 'authorization/registration',
                    'completed' => true,
                ],
                [
                    'name' => 'create other entities',
                    'completed' => true,
                ],
                [
                    'name' => 'create crud for entities',
                    'completed' => true,
                ],
                [
                    'name' => 'restrict new/edit actions for non-authorized user (security.yaml I guess)',
                    'completed' => true
                ],
                [
                    'name' => 'upload images to filesystem',
                    'completed' => true
                ],
            ]
        ]);
    }
}