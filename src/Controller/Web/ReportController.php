<?php

namespace App\Controller\Web;

use App\Repository\Report\ReportCostRepository;
use App\Repository\Report\ReportLengthRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/report")
 */
class ReportController extends AbstractController
{

    /**
     * @param ReportCostRepository $reportCostRepository
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/cost/", name="report_cost")
     */
    public function reportCost(ReportCostRepository $reportCostRepository): Response
    {
        $array = [];
        foreach ($reportCostRepository->findBy([], ['dateTime' => 'ASC']) as $reportCost) {
            $array[] = [date('d-m-Y', $reportCost->getDateTime()), $reportCost->getValue()];
        }
        return $this->render('report/cost.html.twig', [
            'reports' => $reportCostRepository->findAll(),
            'array' => $array
        ]);
    }

    /**
     * @param ReportLengthRepository $reportLengthRepository
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/length/", name="report_length")
     */
    public function reportLength(ReportLengthRepository $reportLengthRepository): Response
    {
        $array = [];
        foreach ($reportLengthRepository->findBy([], ['dateTime' => 'ASC']) as $reportLength) {
            $array[] = [date('d-m-Y', $reportLength->getDateTime()), $reportLength->getValue()];
        }
        return $this->render('report/length.html.twig', [
            'reports' => $reportLengthRepository->findAll(),
            'array' => $array
        ]);
    }
}
