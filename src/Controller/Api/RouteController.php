<?php

namespace App\Controller\Api;

use App\Entity\Route;
use App\Repository\RouteRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as SymfonyRoute;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @SymfonyRoute("/route")
 */
class RouteController extends AbstractController
{
    /**
     * @SymfonyRoute("/", name="api_route_index", methods={"GET"})
     * @SWG\Tag(name="Routes")
     * @SWG\Response(
     *     response=200,
     *     description="Returns routes",
     *     @SWG\Schema(
     *          @Model(type=Route::class, groups={"route_show"})
     *     )
     * )
     *
     */
    public function index(RouteRepository $repository, SerializerInterface $serializer): Response
    {
        $jsonResponse = new JsonResponse();
        $jsonResponse->setJson($serializer->serialize(
            $repository->findAll(),
            'json',
            ['groups' => ['route_show']]
        ));
        return $jsonResponse;
    }
}
