<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 21/07/2019
 * Time: 00:47
 */

namespace App\Serializer\Denormalize;

use App\Entity\NationalProgram;
use App\Helper\DenormalizerTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class NationalProgramDenormalizer implements DenormalizerInterface
{
    use DenormalizerTrait;

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        /** @var Layout $layout */
        $entity = $this->getEntity($data, $class);
        return $entity;
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return new $type() instanceof NationalProgram;
    }
}
