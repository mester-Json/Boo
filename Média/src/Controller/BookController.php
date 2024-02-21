<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BookRepository;

class BookController extends AbstractController
{
    #[Route('/book/{id}', name: 'book_detail')]
    public function bookDetail(BookRepository $bookRepository, $id): Response
    {
        $book = $bookRepository->find($id);

        if (!$book) {
            throw $this->createNotFoundException('Le livre demandé n\'existe pas');
        }

        return $this->render('book/index.html.twig', [
            'book' => $book,
        ]);
    }
}
