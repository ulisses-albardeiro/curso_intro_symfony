<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private PostRepository $postRepository,
        ) {}

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'title' => 'Inicio do blog',
            'categories' => $this->categoryRepository->findAll(),
            'posts' => $this->postRepository->findAll(),
        ]);
    }
}
