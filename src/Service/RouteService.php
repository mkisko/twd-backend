<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 21/07/2019
 * Time: 03:56
 */

namespace App\Service;


use App\Entity\Route;
use App\Filter\RouteFilter;
use App\Repository\RouteRepository;

class RouteService
{
    /** @var RouteRepository  */
    protected $repository;

    public function __construct(RouteRepository $repository)
    {
        $this->repository = $repository;
    }

    /** @var Route[] */
    public function findRoutes(RouteFilter $routeFilter = null)
    {
        $entities = $this->repository->findByFilter($routeFilter ?: new RouteFilter());
        $entities = array_map(function (Route $route) {
            $route->setEfficiency($this->getEfficiency($route));
            return $route;
        }, $entities);
        return $entities;
    }

    protected function getEfficiency(Route $route)
    {
        $costK = $route->getCost() ?: 1;
        $lengthK = $route->getLength() ?: 1;
        $priorityK = $route->getPriority() ?: 1;
        $trafficK = $route->getTraffic() ?: 1;
        $sumNationalProgramK = $route->getSumNationalProgram() ?: 1;
        return $costK*$lengthK*$priorityK*$trafficK*$sumNationalProgramK;
    }
}