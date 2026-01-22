<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/{slug}', name: 'app_post', methods: ['GET'])]
    public function show(#[MapEntity(mapping:['slug' => 'slug'])] Post $post): Response
    {
        return $this->render(
            'post/post.html.twig',
            [
                'post' => $post,
                'categories' => $this->categoryRepository->findAll(),
            ]
        );
    }

    #[Route('category/{slug}', name: 'app_category', methods: ['GET'])]
    public function category(#[MapEntity(mapping:['slug' => 'slug'])] Category $category): Response
    {
        return $this->render(
            'post_category/posts_category.html.twig',
            [
                'category' => $category,
                'posts' => $category->getPosts(),
                'categories' => $this->categoryRepository->findAll(),
            ]
        );
    }

    #[Route('search', name:'app_search', methods:['POST'])]
    public function search(Request $request)
    {
        $data = $request->request->all();

        dd($data['search']);
    }
}
