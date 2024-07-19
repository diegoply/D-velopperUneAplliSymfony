<?php

namespace App\Controller;

use App\Entity\Marque;
use App\Form\MarqueType;
use App\Repository\MarqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MarqueController extends AbstractController
{
    #[Route('/marque', name: 'marque_index', methods: ['GET'])]
    public function index(MarqueRepository $marqueRepository): Response
    {
        return $this->render('marque/index.html.twig', [
            'marques' => $marqueRepository->findAll()
        ]);
    }

    #[Route('/marque/{id}', name: 'marque_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(Marque $marque): Response
    {
         
        return $this->render('marque/show.html.twig', [
            'marques' => $marque,
        ]);
    }

    #[Route('/marque/create', name: 'marque_create', priority: 10, methods: ['GET', 'POST'])]
    public function create(Request $request, MarqueRepository $repo): Response
    {

        $marque = new Marque();

        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $repo->save($marque, true);
            return $this->redirectToRoute('marque_index');
            
        }

        return $this->render('marque/create.html.twig',[
            'formView' => $form->createView(),
           
        ]);
    }

    #[Route('/marque/{id}/edit', name: 'marque_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Marque $marque, Request $request, MarqueRepository $repo): Response
    {
        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $repo->save($marque, true);
            return $this->redirectToRoute('marque_index');
        }

        return $this->render('marque/edit.html.twig', [
            'formView' => $form->createView(),
        ]);


    }

    #[Route('/marque/{id}/delete', name: 'marque_delete', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function delete(Marque $marque, MarqueRepository  $repo): Response
    {
        $repo->remove($marque, true);
        return $this->redirectToRoute('marque_index');
    }
}
