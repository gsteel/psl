<?php

declare(strict_types=1);

namespace Psl\IO;

use Psl\Str;

/**
 * Write all of the requested data to the error output handle.
 *
 * The $message will be formatted using the given arguments ( ...$args ).
 *
 * If the error output handle is not available, this function will return immediately.
 *
 * @param int|float|string ...$args
 *
 * @throws Exception\AlreadyClosedException If the output handle has been already closed.
 * @throws Exception\RuntimeException If an error occurred during the operation.
 *
 * @codeCoverageIgnore
 */
function write_error(string $message, mixed ...$args): void
{
    /**
     * @psalm-suppress MissingThrowsDocblock - we won't encounter timeout, or already closed exception.
     */
    error_handle()?->writeAll(Str\format($message, ...$args));
}
