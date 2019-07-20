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
use App\Helper\DenormalizerTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class PointDenormalizer implements DenormalizerInterface
{
    use DenormalizerTrait;

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        /** @var Point $point */
        $point = $this->getEntity($data, $class);
        $point->setType($data['type'] ?? $point->getType());
        $point->setLongitude($data['longitude'] ?? $point->getLongitude());
        $point->setLatitude($data['latitude'] ?? $point->getLatitude());
        if (array_key_exists('layouts', $data)) {
            foreach ($data['layouts'] as $dataLayout) {
                /** @var Layout $layout */
                $layout = $this->getSerializer()->denormalize($dataLayout, Layout::class, $format, $context);
                $point->addLayout($layout);
            }
        }
        if (array_key_exists('routes', $data)) {
            foreach ($data['routes'] as $dataRoute) {
                /** @var Route $route */
                $route = $this->getSerializer()->denormalize($dataRoute, Route::class, $format, $context);
                $point->addRoute($route);
            }
        }
        return $point;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return new $type() instanceof Point;
    }
}
