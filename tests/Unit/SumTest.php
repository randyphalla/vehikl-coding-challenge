<?php

// test('example', function () {
//     expect(true)->toBeTrue();
// });

function sum($a, $b)
{
    return $a + $b;
}

test('sum', function () {
   $result = sum(1, 2);

   expect($result)->toBe(3);
});

test('sum 1', function () {
   $result = sum(1, 2);

   $this->assertSame(3, $result); // Same as expect($result)->toBe(3)
});

it('performs sums', function () {
   $result = sum(1, 2);

   expect($result)->toBe(3);
});

describe('sum', function () {
   it('may sum integers', function () {
       $result = sum(1, 2);

       expect($result)->toBe(3);
    });

    it('may sum floats', function () {
       $result = sum(1.5, 2.5);

       expect($result)->toBe(4.0);
    });
});
