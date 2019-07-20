<?php

namespace App\Controller\Web;

use App\Entity\Layout;
use App\Form\LayoutType;
use App\Repository\LayoutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/layout")
 */
class LayoutController extends AbstractController
{
    /**
     * @Route("/", name="layout_index", methods={"GET"})
     */
    public function index(LayoutRepository $layoutRepository): Response
    {
        return $this->render('layout/index.html.twig', [
            'layouts' => $layoutRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="layout_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $layout = new Layout();
        $form = $this->createForm(LayoutType::class, $layout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($layout);
            $entityManager->flush();

            return $this->redirectToRoute('layout_index');
        }

        return $this->render('layout/new.html.twig', [
            'layout' => $layout,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="layout_show", methods={"GET"})
     */
    public function show(Layout $layout): Response
    {
        return $this->render('layout/show.html.twig', [
            'layout' => $layout,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="layout_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Layout $layout): Response
    {
        $form = $this->createForm(LayoutType::class, $layout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('layout_index');
        }

        return $this->render('layout/edit.html.twig', [
            'layout' => $layout,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="layout_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Layout $layout): Response
    {
        if ($this->isCsrfTokenValid('delete'.$layout->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($layout);
            $entityManager->flush();
        }

        return $this->redirectToRoute('layout_index');
    }
}
