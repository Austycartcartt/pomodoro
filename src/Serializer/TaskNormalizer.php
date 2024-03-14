<?php

namespace App\Serializer;

use App\Entity\Task;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class TaskNormalizer implements ContextAwareNormalizerInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof Task;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        // Normalize the Task entity
        return $this->normalizer->normalize($object, $format, $context);
    }
}
