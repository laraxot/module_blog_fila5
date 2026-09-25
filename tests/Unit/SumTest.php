<?php

declare(strict_types=1);

<<<<<<< HEAD
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
=======
use PHPUnit\Framework\Assert;

>>>>>>> b591d4e (Lint)
function sum(int|float $a, int|float $b): int|float
{
    return $a + $b;
}

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> b591d4e (Lint)
it('sum', function (): void {
    $result = sum(1, 2);

    Assert::assertSame(3, $result);
<<<<<<< HEAD
=======
test('sum', function (): void {
    Assert::assertSame(3, sum(1, 2));
>>>>>>> laraxot/dev
=======
>>>>>>> b591d4e (Lint)
});
