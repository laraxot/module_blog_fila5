<?php

declare(strict_types=1);

<<<<<<< HEAD
use PHPUnit\Framework\Assert;

=======
use Modules\Blog\Tests\TestCase;
use PHPUnit\Framework\Assert;

uses(TestCase::class);

/**
 * Sum test function.
 *
 * @param int|float $a First operand
 * @param int|float $b Second operand
 *
 * @return int|float Sum of a and b
 */
>>>>>>> laraxot/dev
function sum(int|float $a, int|float $b): int|float
{
    return $a + $b;
}

<<<<<<< HEAD
it('sum', function (): void {
    $result = sum(1, 2);

    Assert::assertSame(3, $result);
=======
test('sum', function (): void {
    Assert::assertSame(3, sum(1, 2));
>>>>>>> laraxot/dev
});
