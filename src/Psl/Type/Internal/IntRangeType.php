<?php

declare(strict_types=1);

namespace Psl\Type\Internal;

use Psl\Type;
use Psl\Type\Exception\AssertException;
use Psl\Type\Exception\CoercionException;
use Stringable;

use const PHP_INT_MAX;
use const PHP_INT_MIN;

/**
 * @template TMin of int
 * @template TMax of int
 *
 * @extends Type\Type<int<TMin, TMax>>
 *
 * @internal
 */
final readonly class IntRangeType extends Type\Type
{
    /**
     * @param TMin $min
     * @param TMax $max
     */
    public function __construct(
        private int $min,
        private int $max,
    ) {
    }

    /**
     * @psalm-assert-if-true int $value
     */
    #[\Override]
    public function matches(mixed $value): bool
    {
        return is_int($value) && $value >= $this->min && $value <= $this->max;
    }

    /**
     * @throws CoercionException
     */
    #[\Override]
    public function coerce(mixed $value): int
    {
        $int = $this->coerceToInt($value);
        if ($int >= $this->min && $int <= $this->max) {
            return $int;
        }

        throw CoercionException::withValue($value, $this->toString());
    }

    /**
     * @throws CoercionException
     * @return int<min, max>
     */
    private function coerceToInt(mixed $value): int
    {
        if (is_int($value)) {
            return $value;
        }

        if (is_float($value)) {
            $integer_value = (int) $value;
            if (((float) $integer_value) === $value) {
                return $integer_value;
            }
        }

        if (is_string($value) || $value instanceof Stringable) {
            $str = (string) $value;
            $int = (int) $str;
            if ($str === ((string) $int)) {
                return $int;
            }

            $trimmed = ltrim($str, '0');
            $int = (int) $trimmed;
            if ($trimmed === ((string) $int)) {
                return $int;
            }

            // Exceptional case "000" -(trim)-> "", but we want to return 0
            if ('' === $trimmed && '' !== $str) {
                return 0;
            }
        }

        throw CoercionException::withValue($value, $this->toString());
    }

    /**
     * @psalm-assert int $value
     *
     * @throws AssertException
     */
    #[\Override]
    public function assert(mixed $value): int
    {
        if (is_int($value) && $value >= $this->min && $value <= $this->max) {
            return $value;
        }

        throw AssertException::withValue($value, $this->toString());
    }

    #[\Override]
    public function toString(): string
    {
        $min = $this->min === PHP_INT_MIN ? 'min' : ((string) $this->min);
        $max = $this->max === PHP_INT_MAX ? 'max' : ((string) $this->max);

        return sprintf('int<%s, %s>', $min, $max);
    }
}
