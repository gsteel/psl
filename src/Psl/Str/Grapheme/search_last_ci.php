<?php

declare(strict_types=1);

namespace Psl\Str\Grapheme;

use Psl\Str;

use function grapheme_strripos;

/**
 * Returns the last position of the 'needle' string in the 'haystack' string,
 * or null if it isn't found (case-insensitive).
 *
 * An optional offset determines where in the haystack (from the beginning) the
 * search begins.
 *
 * If the offset is negative, the search will begin that many
 * characters from the end of the string and go backwards.
 *
 * @pure
 *
 * @throws Str\Exception\OutOfBoundsException If $offset is out-of-bounds.
 * @throws Str\Exception\InvalidArgumentException If $haystack is not made of grapheme clusters.
 *
 * @return null|int<0, max>
 *
 * @mago-ignore best-practices/no-boolean-literal-comparison
 */
function search_last_ci(string $haystack, string $needle, int $offset = 0): null|int
{
    if ('' === $needle) {
        return null;
    }

    $offset = Str\Internal\validate_offset($offset, length($haystack));

    /** @var null|int<0, max> */
    return false === ($pos = grapheme_strripos($haystack, $needle, $offset)) ? null : $pos;
}
