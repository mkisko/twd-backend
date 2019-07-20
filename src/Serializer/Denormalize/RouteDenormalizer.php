<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 21/07/2019
 * Time: 00:47
 */

namespace App\Serializer\Denormalize;


use App\Entity\Layout;
use App\Entity\Point;
use App\Entity\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class RouteDenormalizer implements DenormalizerInterface
{
    /** @var EntityManagerInterface */
    protected $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (array_key_exists('id', $data)) {
            $route = $this->em->getRepository(Route::class)->find($data['id']);
            if (!$route) {
                $route = new Route();
            }
        }
        $route->setCost($data['cost'] ?? null);
        $route->setLength($data['length'] ?? null);
        $route->setPriority($data['priority'] ?? null);
        $route->setTraffic($data['traffic'] ?? null);
        if (array_key_exists('points', $data)) {
            foreach ($data['points'] as $dataPoint) {
                if (array_key_exists('id', $dataPoint)) {
                    $point = $this->em->getRepository(Point::class)->find($dataPoint['id']);
                    if (!$point) {
                        $point = new Point();
                    }
                    $point->setType($dataPoint['type'] ?? $point->getType());
                    $point->setLongitude($dataPoint['longitude'] ?? $point->getLongitude());
                    $point->setLatitude($dataPoint['latitude'] ?? $point->getLatitude());
                    if (array_key_exists('layouts', $dataPoint)) {
                        foreach ($dataPoint['layouts'] as $dataLayout) {
                            if (array_key_exists('id', $dataLayout)) {
                                $layout = $this->em->getRepository(Layout::class)->find($dataLayout['id']);
                                if ($layout) {
                                    $point->addLayout($layout);
                                }
                            }
                        }
                    }
                    $route->addPoint($point);
                }
            }
        }
        return $route;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        $b = new $type() instanceof Route;
        return $b;
    }
}
