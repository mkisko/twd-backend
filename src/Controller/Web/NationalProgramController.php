<?php

namespace App\Controller\Web;

use App\Entity\NationalProgram;
use App\Form\NationalProgramType;
use App\Repository\NationalProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/national/program")
 */
class NationalProgramController extends AbstractController
{
    /**
     * @Route("/", name="national_program_index", methods={"GET"})
     */
    public function index(NationalProgramRepository $nationalProgramRepository): Response
    {
        return $this->render('national_program/index.html.twig', [
            'national_programs' => $nationalProgramRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="national_program_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $nationalProgram = new NationalProgram();
        $form = $this->createForm(NationalProgramType::class, $nationalProgram);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nationalProgram);
            $entityManager->flush();

            return $this->redirectToRoute('national_program_index');
        }

        return $this->render('national_program/new.html.twig', [
            'national_program' => $nationalProgram,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="national_program_show", methods={"GET"})
     */
    public function show(NationalProgram $nationalProgram): Response
    {
        return $this->render('national_program/show.html.twig', [
            'national_program' => $nationalProgram,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="national_program_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NationalProgram $nationalProgram): Response
    {
        $form = $this->createForm(NationalProgramType::class, $nationalProgram);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('national_program_index');
        }

        return $this->render('national_program/edit.html.twig', [
            'national_program' => $nationalProgram,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="national_program_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NationalProgram $nationalProgram): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nationalProgram->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($nationalProgram);
            $entityManager->flush();
        }

        return $this->redirectToRoute('national_program_index');
    }
}
