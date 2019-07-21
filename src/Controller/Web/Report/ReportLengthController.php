<?php

namespace App\Controller\Web\Report;

use App\Entity\Report\ReportLength;
use App\Form\Report\ReportLengthType;
use App\Repository\Report\ReportLengthRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/report/report/length")
 */
class ReportLengthController extends AbstractController
{
    /**
     * @Route("/", name="report_report_length_index", methods={"GET"})
     */
    public function index(ReportLengthRepository $reportLengthRepository): Response
    {
        return $this->render('report/report_length/index.html.twig', [
            'report_lengths' => $reportLengthRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="report_report_length_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reportLength = new ReportLength();
        $form = $this->createForm(ReportLengthType::class, $reportLength);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reportLength);
            $entityManager->flush();

            return $this->redirectToRoute('report_report_length_index');
        }

        return $this->render('report/report_length/new.html.twig', [
            'report_length' => $reportLength,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="report_report_length_show", methods={"GET"})
     */
    public function show(ReportLength $reportLength): Response
    {
        return $this->render('report/report_length/show.html.twig', [
            'report_length' => $reportLength,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="report_report_length_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ReportLength $reportLength): Response
    {
        $form = $this->createForm(ReportLengthType::class, $reportLength);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('report_report_length_index');
        }

        return $this->render('report/report_length/edit.html.twig', [
            'report_length' => $reportLength,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="report_report_length_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ReportLength $reportLength): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reportLength->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reportLength);
            $entityManager->flush();
        }

        return $this->redirectToRoute('report_report_length_index');
    }
}
