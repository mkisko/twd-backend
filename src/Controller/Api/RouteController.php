<?php

namespace App\Controller\Api;

use App\Entity\Route;
use App\Filter\RouteFilter;
use App\Repository\RouteRepository;
use App\Service\RouteService;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as SymfonyRoute;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @SymfonyRoute("/route")
 */
class RouteController extends AbstractController
{
    /**
     * @param Request $request
     * @param RouteService $routeService
     * @param SerializerInterface $serializer
     * @param DenormalizerInterface $denormalizer
     * @return Response
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     *
     *
     * @SymfonyRoute("/", name="api_route_index", methods={"GET"})
     *
     * @SWG\Tag(name="Routes")
     * @SWG\Parameter(
     *         name="ecologic",
     *         in="query",
     *         description="Экология",
     *         type="string",
     *     ),
     * @SWG\Parameter(
     *         name="trafficJam",
     *         in="query",
     *         description="Пробки",
     *         type="string",
     *     ),
     * @SWG\Parameter(
     *         name="cost",
     *         in="query",
     *         description="Стоимость",
     *         type="string",
     *     ),
     * @SWG\Parameter(
     *         name="traffic",
     *         in="query",
     *         description="Востребованность",
     *         type="string",
     *     ),
     * @SWG\Parameter(
     *         name="priority",
     *         in="query",
     *         description="Приоритет",
     *         type="string",
     *     ),
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns routes",
     *     @SWG\Schema(
     *          @Model(type=Route::class, groups={"route_show"})
     *     )
     * )
     */
    public function index(Request $request, RouteService $routeService, SerializerInterface $serializer, DenormalizerInterface $denormalizer): Response
    {
        $filter = $denormalizer->denormalize($request->query->all(), RouteFilter::class);
        $jsonResponse = new JsonResponse();
        $jsonResponse->setJson($serializer->serialize(
            $routeService->findRoutes($filter),
            'json',
            ['groups' => ['route_show']]
        ));
        return $jsonResponse;
    }

    /**
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param SerializerInterface $serializer
     * @return Response
     *
     * @SymfonyRoute("/", name="api_route_create", methods={"POST"})
     *
     * @SWG\Tag(name="Routes")
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Create route.",
     *     required=true,
     *     @SWG\Schema(
     *          @Model(type=Route::class, groups={"route_create"})
     *     )
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returns route",
     *     @SWG\Schema(
     *          @Model(type=Route::class, groups={"route_show"})
     *     )
     * )
     */
    public function create(EntityManagerInterface $em, Request $request, SerializerInterface $serializer): Response
    {
        $route = $serializer->deserialize(
            $request->getContent(),
            Route::class,
            'json',
            ['groups' => ['route_show']]
        );
        $em->persist($route);
        $em->flush();
        $response = new JsonResponse();
        $response->setJson($serializer->serialize(
            $route,
            'json',
            ['groups' => ['route_show']]
        ));
        return $response;
    }
}
