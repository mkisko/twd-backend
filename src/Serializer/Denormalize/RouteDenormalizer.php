<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 21/07/2019
 * Time: 00:47
 */

namespace App\Serializer\Denormalize;


use App\Entity\NationalProgram;
use App\Entity\Point;
use App\Entity\Route;
use App\Helper\DenormalizerTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class RouteDenormalizer implements DenormalizerInterface
{
    use DenormalizerTrait;

    /**
     * @param mixed $data
     * @param string $class
     * @param null $format
     * @param array $context
     * @return Route|object
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        /** @var Route $route */
        $route = $this->getEntity($data, $class);
        $route->setCost($data['cost'] ?? null);
        $route->setLength($data['length'] ?? null);
        $route->setPriority($data['priority'] ?? null);
        $route->setTraffic($data['traffic'] ?? null);
        $route->setTrafficJam($data['trafficJam'] ?? null);
        $route->setEcologic($data['ecologic'] ?? null);
        if (array_key_exists('points', $data)) {
            foreach ($data['points'] as $dataPoint) {
                /** @var Point $point */
                $point = $this->getSerializer()->denormalize($dataPoint, Point::class, $format, $context);
                $route->addPoint($point);
            }
        }
        if (array_key_exists('nationalPrograms', $data)) {
            foreach ($data['nationalPrograms'] as $dataNationalProgram) {
                /** @var NationalProgram $nationalProgram */
                $nationalProgram = $this->getSerializer()->denormalize(
                    $dataNationalProgram,
                    NationalProgram::class,
                    $format,
                    $context
                );
                $route->addNationalProgram($nationalProgram);
            }
        }
        return $route;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return new $type() instanceof Route;
    }
}
