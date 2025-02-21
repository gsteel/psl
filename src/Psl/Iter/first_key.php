<?php

declare(strict_types=1);

namespace Psl\Iter;

/**
 * Returns the first key of an iterable, if the iterable is empty, null will be returned.
 *
 * @template Tk
 * @template Tv
 *
 * @param iterable<Tk, Tv> $iterable
 *
 * @return Tk|null
 *
 * @mago-ignore best-practices/loop-does-not-iterate
 */
function first_key(iterable $iterable): mixed
{
    foreach ($iterable as $k => $_) {
        return $k;
    }

    return null;
}
