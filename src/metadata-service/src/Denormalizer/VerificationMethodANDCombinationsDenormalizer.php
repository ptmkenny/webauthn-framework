<?php

declare(strict_types=1);

namespace Webauthn\MetadataService\Denormalizer;

use ArrayObject;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Webauthn\MetadataService\Statement\VerificationMethodANDCombinations;
use function assert;

final class VerificationMethodANDCombinationsDenormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * @return array<class-string, bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            VerificationMethodANDCombinations::class => true,
        ];
    }

    public function normalize(
        mixed $object,
        ?string $format = null,
        array $context = []
    ): array|string|int|float|bool|ArrayObject|null {
        assert($object instanceof VerificationMethodANDCombinations);

        return array_map(
            fn ($verificationMethod) => $this->normalizer->normalize($verificationMethod, $format, $context),
            $object->verificationMethods
        );
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof VerificationMethodANDCombinations;
    }
}
