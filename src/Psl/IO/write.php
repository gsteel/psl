<?php

declare(strict_types=1);

namespace Psl\IO;

use Psl\Str;

/**
 * Write all of the requested data to the output handle.
 *
 * The $message will be formatted using the given arguments ( ...$args ).
 *
 * @param int|float|string ...$args
 *
 * @throws Exception\AlreadyClosedException If the output handle has been already closed.
 * @throws Exception\RuntimeException If an error occurred during the operation.
 *
 * @codeCoverageIgnore
 */
function write(string $message, mixed ...$args): void
{
    /**
     * @psalm-suppress MissingThrowsDocblock - we won't encounter timeout.
     */
    output_handle()->writeAll(Str\format($message, ...$args));
}
