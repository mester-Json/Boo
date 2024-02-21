<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BookRepository;


class HomeController extends AbstractController
{

    #[Route('/home', name: 'home')]
    public function book(BookRepository $BookRepository): Response
    {
        $books = $BookRepository->findAll();

        if (!$books) {
            throw $this->createNotFoundException('La personne demandée n\'existe pas');
        }

        return $this->render('home/index.html.twig', [
            'books' => $books,
        ]);
    }
}












