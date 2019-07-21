<?php

namespace App\Controller\Web\Report;

use App\Entity\Report\ReportCost;
use App\Form\Report\ReportCostType;
use App\Repository\Report\ReportCostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/report/report/cost")
 */
class ReportCostController extends AbstractController
{
    /**
     * @Route("/", name="report_report_cost_index", methods={"GET"})
     */
    public function index(ReportCostRepository $reportCostRepository): Response
    {
        return $this->render('report/report_cost/index.html.twig', [
            'report_costs' => $reportCostRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="report_report_cost_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reportCost = new ReportCost();
        $form = $this->createForm(ReportCostType::class, $reportCost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reportCost);
            $entityManager->flush();

            return $this->redirectToRoute('report_report_cost_index');
        }

        return $this->render('report/report_cost/new.html.twig', [
            'report_cost' => $reportCost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="report_report_cost_show", methods={"GET"})
     */
    public function show(ReportCost $reportCost): Response
    {
        return $this->render('report/report_cost/show.html.twig', [
            'report_cost' => $reportCost,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="report_report_cost_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ReportCost $reportCost): Response
    {
        $form = $this->createForm(ReportCostType::class, $reportCost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('report_report_cost_index');
        }

        return $this->render('report/report_cost/edit.html.twig', [
            'report_cost' => $reportCost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="report_report_cost_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ReportCost $reportCost): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reportCost->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reportCost);
            $entityManager->flush();
        }

        return $this->redirectToRoute('report_report_cost_index');
    }
}
