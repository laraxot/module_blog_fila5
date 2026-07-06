<?php

use Modules\Blog\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

/**
 * Sum test function.
 *
 * @param int|float $a First operand
 * @param int|float $b Second operand
 * @return int|float Sum of a and b
 */
function sum(int|float $a, int|float $b): int|float
{
    return $a + $b;
}

test('sum', function (): void {
    Assert::assertSame(3, sum(1, 2));
});
