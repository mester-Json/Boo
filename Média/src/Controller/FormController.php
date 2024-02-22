<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Book;
use App\Entity\Author;
use App\Entity\Editor;
use App\Form\BookType;


class FormController extends AbstractController
{

    #[Route('/form', name: 'book_add')]
    public function creat(Request $request, EntityManagerInterface $em): Response
    {
        $person = new Book();
        $author = $em->getRepository(Author::class)->findAll();
        $editor = $em->getRepository(Editor::class)->findAll();
        $form = $this->createForm(BookType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($person);
            $em->flush();

            return $this->redirectToRoute('book_add');
        }

        return $this->render('form/index.html.twig', [
            'form' => $form->createView(),
            'authors' => $author,
            'editor' => $editor,
        ]);
    }


}
