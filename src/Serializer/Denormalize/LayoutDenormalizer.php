<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 21/07/2019
 * Time: 00:47
 */

namespace App\Serializer\Denormalize;


use App\Entity\Layout;
use App\Helper\DenormalizerTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class LayoutDenormalizer implements DenormalizerInterface
{
    use DenormalizerTrait;

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        /** @var Layout $layout */
        $layout = $this->getEntity($data, $class);
        return $layout;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return new $type() instanceof Layout;
    }
}
