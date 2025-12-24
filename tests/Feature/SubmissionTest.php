<?php

// test('basic', function () {
//     expect(true)->toBeTrue();
// });

// TODO: test form page
test('visit form page', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});

// check if current_odometer is less than 5000 km

// check if current_odometer is over 5000 km

// check if current_odometer is greater than equal to previous_oil_change_odometer

// check if current_odometer is less than previous_oil_change_odometer

// check if previous_oil_change_date is today

// check if previous_oil_change_date is past

// check if previous_oil_change_date is over 6 months

// submitting the form
test('submit form', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});

test('submit form with errors', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});

// test result without id and it should return 404
// test('test result without id', function () {
//     $response = $this->get('/result');
//     $response->assertStatus(404);
// });

// test result with id and it should result 200 with the result response
describe('submission success and visit result page with id', function () {
    test('submit form', function() {

    });

    test('result page with id', function() {

    });
});

// i wanna test if submission is success and car doesn't need oil change
describe('submission success and car doesnt need oil change', function () {
});

// test if submission is success and car have over 5000 km
describe('submission success and car has over 5000km', function () {

});

// test if submission is success and car hasn't changed their oil for over 6 months
describe('submission success and hasnt changed their oil over 6 months', function () {

});

// test if submission is success and car have over 5000k and haven't change their oil over 6 months
describe('submission success, car has over 5000km and hasnt changed their oil over 6 months', function () {
});