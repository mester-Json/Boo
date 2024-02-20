<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class FormController extends AbstractController
{

    #[Route('/form', name: 'app_form')]
    public function creat(Request $request, EntityManagerInterface $em): Response
    {
        $person = new Book();
        $form = $this->createForm(BookType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($person);
            $em->flush();



            return $this->redirectToRoute('app_form');
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
