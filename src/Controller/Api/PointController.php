<?php

namespace App\Controller\Api;

use App\Entity\Point;
use App\Form\PointType;
use App\Repository\PointRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Swagger\Annotations as SWG;

/**
 * @Route("/point")
 */
class PointController extends AbstractController
{
    /**
     * @Route("/", name="api_point_index", methods={"GET"})
     * @SWG\Tag(name="Points")
     * @SWG\Response(
     *     response=200,
     *     description="Returns points",
     *     @SWG\Schema(
     *          @Model(type=Point::class, groups={"point_show"})
     *     )
     * )
     *
     */
    public function index(PointRepository $repository, SerializerInterface $serializer): Response
    {
        $jsonResponse = new JsonResponse();
        $jsonResponse->setJson($serializer->serialize(
            $repository->findAll(),
            'json',
            ['groups' => ['point_show']]
        ));
        return $jsonResponse;
    }
}
