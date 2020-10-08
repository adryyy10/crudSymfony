<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Film;


class ListController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Film::class);

        // look for *all* film objects
        $films = $repository->findAll();


        return $this->render('list/list.html.twig', [
            'films' => $films
        ]);
    }
}
