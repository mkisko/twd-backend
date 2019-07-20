<?php

namespace App\Controller\Api;

use App\Entity\Route;
use App\Form\RouteType;
use App\Repository\RouteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     *
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

    /**
     * @param EntityManagerInterface $em
     * @param Request $request
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
