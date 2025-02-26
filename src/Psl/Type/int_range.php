<?php

declare(strict_types=1);

namespace Psl\Type;

/**
 * @return TypeInterface<int<TMin, TMax>>
 * @template TMin of int
 * @template TMax of int
 * @param TMin $min
 * @param TMax $max
 */
function int_range(int $min, int $max): TypeInterface
{
    return new Internal\IntRangeType($min, $max);
}
