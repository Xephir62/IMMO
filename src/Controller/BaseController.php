<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AppartementType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Appartement;
use Doctrine\ORM\EntityManagerInterface;



class BaseController extends AbstractController
{
    #[Route('/base', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('base/index.html.twig', []);
    }

    #[Route('/ajoutappartement', name: 'app_ajoutappartement')]
    public function ajoutappartement(Request $request, EntityManagerInterface $em): Response
    {
        $ajoutappartement = new Appartement();
        $form = $this->createForm(AppartementType::class, $ajoutappartement);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($ajoutappartement);
                $em->flush();
                $this->addFlash('notice', 'Message envoyé');
                return $this->redirectToRoute('app_ajoutappartement');
            }
        }
        return $this->render('base/ajoutappartement.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
