<?php

declare(strict_types=1);

namespace Psl\Tests\Unit\Str\Grapheme;

use PHPUnit\Framework\TestCase;
use Psl\Str\Grapheme;

final class AfterCiTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testAfter(null|string $expected, string $haystack, string $needle, int $offset): void
    {
        static::assertSame($expected, Grapheme\after_ci($haystack, $needle, $offset));
    }

    public function provideData(): array
    {
        return [
            [null, '', '', 0],
            ['orld!', 'Hello, World!', 'W', 0],
            ['!', '🤷!', '🤷', 0],
            [null, 'مرحبا بكم', '', 0],
            [null, 'مرحبا بكم', 'ß', 0],
            [', wôrld!', 'héllö, wôrld!', 'héllö', 0],
            [', wôrld!', 'ḫéllö, wôrld!', 'ḫéllö', 0],
            [', wôrld!', 'ḫéllö, wôrld!', 'Ḫéllö', 0],
            [', wôrld!', 'Ḫéllö, wôrld!', 'Ḫéllö', 0],
            [', world!', 'Hello, world!', 'Hello', 0],
            [', world!', 'Hello, world!', 'hello', 0],
            [', world!', 'hello, world!', 'Hello', 0],
            [', wôrld!', 'Ḫéllö, wôrld!', 'ḫéllö', 0],
            ['好', '你好', '你', 0],
            ['にちは世界', 'こんにちは世界', 'こん', 0],
            ['สดี', 'สวัสดี', 'วั', 0],
            [', world!', 'Hello, world!', 'o', 0],
            ['rld!', 'Hello, world!', 'o', 7],
        ];
    }
}
