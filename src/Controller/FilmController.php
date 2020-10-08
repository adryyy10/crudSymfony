<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class FilmController extends AbstractController
{



    /**
     * @Route("/film", name="film"), methods={"POST"}
     */
    public function createFilm(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $film = new Film();
        $film->setTitle($_POST['title1']);
        $film->setSinopsis($_POST['sinopsis1']);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($film);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        // redirects to the "list" route
        return $this->redirectToRoute('list');
    }

    /**
     * @Route("/product/edit/{id}", name="update_film"), methods={"POST"}
     */
    public function updateFilm($id): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();
        $film = $entityManager->getRepository(Film::class)->find($id);

        $film->setTitle($_POST['title1']);
        $film->setSinopsis($_POST['sinopsis1']);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        // redirects to the "list" route
        return $this->redirectToRoute('list');
    }

    /**
     * @Route("/film/{id}", name="film_show")
     */
    public function show($id)
    {
        $film = $this->getDoctrine()
            ->getRepository(Film::class)
            ->find($id);

        if (!$film) {
            throw $this->createNotFoundException(
                'No film found for id '.$id
            );
        }
        return $this->render('film/show.html.twig', ['film' => $film]);
    }

        /**
     * @Route("/insert", name="film_insert")
     */
    public function insert()
    {
        return $this->render('film/insert.html.twig');
    }

        /**
     * @Route("/film/delete/{id}", name="film_delete")
     */
    public function delete($id): Response
    {
        
        $entityManager = $this->getDoctrine()->getManager();
        $film = $entityManager->getRepository(Film::class)->find($id);

        $entityManager->remove($film);
        $entityManager->flush();

        // redirects to the "list" route
        return $this->redirectToRoute('list');
    }
}
