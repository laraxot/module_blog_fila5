<?php

declare(strict_types=1);

<<<<<<< HEAD
<<<<<<< .merge_file_jfcZ09
=======
use PHPUnit\Framework\Assert;

=======
>>>>>>> .merge_file_e5WAgq
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
<<<<<<< .merge_file_jfcZ09
=======
use PHPUnit\Framework\Assert;

=======
>>>>>>> .merge_file_e5WAgq
>>>>>>> laraxot/dev
function sum(int|float $a, int|float $b): int|float
{
    return $a + $b;
}

<<<<<<< HEAD
<<<<<<< .merge_file_jfcZ09
test('sum', function (): void {
    Assert::assertSame(3, sum(1, 2));
=======
it('sum', function (): void {
    $result = sum(1, 2);

    Assert::assertSame(3, $result);
=======
it('sum', function (): void {
    $result = sum(1, 2);

    Assert::assertSame(3, $result);
=======
test('sum', function (): void {
    Assert::assertSame(3, sum(1, 2));
>>>>>>> .merge_file_e5WAgq
>>>>>>> laraxot/dev
});
