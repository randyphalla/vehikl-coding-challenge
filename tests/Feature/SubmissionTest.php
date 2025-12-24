<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

pest()->use(RefreshDatabase::class);

test('visit form page', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
});

test('submit form without submitting anything', function() {
    $this->post('/check', [])
    ->assertStatus(302)
    ->assertSessionHasErrors([
        'current_odometer',
        'previous_oil_change_odometer',
        'previous_oil_change_date'
    ]);
});

///////////////////////////////////////////
// Testing: current_odometer
///////////////////////////////////////////
test('submit form: when current_odometer is less than 5000 km', function () {
    $this->post('/check', [
        'current_odometer' => 4000,
        'previous_oil_change_odometer' => 3000,
        'previous_oil_change_date' => Carbon::now()->subDay(1),
    ])->assertStatus(302);
    // ->dump();
    // ->dumpHeaders()
    // ->dumpSession();
});

test('submit form: when current_odometer is over 5000 km', function () {
    $this->post('/check', [
        'current_odometer' => 6000,
        'previous_oil_change_odometer' => 3000,
        'previous_oil_change_date' => Carbon::now()->subDay(1),
    ])->assertStatus(302);
});

///////////////////////////////////////////
// Testing: previous_oil_change_odometer
///////////////////////////////////////////
test('submit form: when current_odometer is less than previous_oil_change_odometer', function () {
    $this->followingRedirects()
        ->post('/check', [
            'current_odometer' => 3000,
            'previous_oil_change_odometer' => 4000,
            'previous_oil_change_date' => Carbon::now()->subDay(1),
        ])
        ->assertSee('Odometer need to be greater than equal to Odemeter at Previous Oil Change');
});

///////////////////////////////////////////
// Testing: previous_oil_change_date field
///////////////////////////////////////////
test('submit form: when previous_oil_change_date is today', function () {
    $this->post('/check', [
        'current_odometer' => 4000,
        'previous_oil_change_odometer' => 3000,
        'previous_oil_change_date' => Carbon::now(),
    ])
    ->assertStatus(302)
    ->assertSessionHasErrors([
        'previous_oil_change_date'
    ]);
});

test('submit form: when previous_oil_change_date is past', function () {
    $this->post('/check', [
        'current_odometer' => 4000,
        'previous_oil_change_odometer' => 3000,
        'previous_oil_change_date' => Carbon::now()->subDay(1),
    ])->assertStatus(302);
});

test('submit form: when previous_oil_change_date is over 6 months', function () {
    $this->post('/check', [
        'current_odometer' => 4000,
        'previous_oil_change_odometer' => 3000,
        'previous_oil_change_date' => Carbon::now()->subMonth(6),
    ])->assertStatus(302);
});

///////////////////////////////////////////
// Testing: visit result page with or without id
///////////////////////////////////////////
test('visit result page without id', function () {
    $this->get('/result')->assertStatus(404);
});

test('visit result page with id but data isnt created', function () {
    $response = $this->get('/result/1');
    $response->assertStatus(404);
});

///////////////////////////////////////////
// Testing: result page
///////////////////////////////////////////
// test result with id and it should result 200 with the result response
describe('submission success and visit result page with id', function () {
    test('submit form', function() {
        $response = $this->post('/check', [
            'current_odometer' => 4000,
            'previous_oil_change_odometer' => 3000,
            'previous_oil_change_date' => Carbon::now()->subDay(1),
        ]);

        // after submitting the form it does a redirect
        $response->assertStatus(302);

        // $response->dump();
        // $response->dumpHeaders();

        // get the location of the redirect
        $location = $response->headers->get('Location');

        // go to result page
        $resultRes = $this->get($location);

        // return 200 if the page is success
        $resultRes->assertStatus(200);
    });
});

// i wanna test if submission is success and car doesn't need oil change
describe('submission success and car doesnt need oil change', function () {
    test('submit form', function() {
        $response = $this->post('/check', [
            'current_odometer' => 4000,
            'previous_oil_change_odometer' => 3000,
            'previous_oil_change_date' => Carbon::now()->subDay(1),
        ]);

        // after submitting the form it does a redirect
        $response->assertStatus(302);

        // get the location of the redirect
        $location = $response->headers->get('Location');

        // go to result page
        $resultRes = $this->get($location);

        // return 200 if the page is success
        $resultRes->assertStatus(200);

        // check if contains the word
        $resultRes->assertSeeText('Your car doesnt need an oil change!!');
    });
});

// test if submission is success and car have over 5000 km
describe('submission success and car has over 5000km', function () {
    test('submit form', function() {
        $response = $this->post('/check', [
            'current_odometer' => 6000,
            'previous_oil_change_odometer' => 3000,
            'previous_oil_change_date' => Carbon::now()->subDay(1),
        ]);

        // after submitting the form it does a redirect
        $response->assertStatus(302);

        // get the location of the redirect
        $location = $response->headers->get('Location');

        // go to result page
        $resultRes = $this->get($location);

        // return 200 if the page is success
        $resultRes->assertStatus(200);

        // check if contains the word
        $resultRes->assertSeeText('Car has over 5000 KM, time to get an oil change!!');
    });
});

// test if submission is success and car hasn't changed their oil for over 6 months
describe('submission success and hasnt changed their oil over 6 months', function () {
    test('submit form', function() {
        $response = $this->post('/check', [
            'current_odometer' => 4000,
            'previous_oil_change_odometer' => 3000,
            'previous_oil_change_date' => Carbon::now()->subMonth(6),
        ]);

        // after submitting the form it does a redirect
        $response->assertStatus(302);

        // get the location of the redirect
        $location = $response->headers->get('Location');

        // go to result page
        $resultRes = $this->get($location);

        // return 200 if the page is success
        $resultRes->assertStatus(200);

        // check if contains the word
        $resultRes->assertSeeText('It been over 6 months since your last oil change!!');
    });
});

// test if submission is success and car have over 5000k and haven't change their oil over 6 months
describe('submission success, car has over 5000km and hasnt changed their oil over 6 months', function () {
    test('submit form', function() {
        $response = $this->post('/check', [
            'current_odometer' => 6000,
            'previous_oil_change_odometer' => 3000,
            'previous_oil_change_date' => Carbon::now()->subMonth(6),
        ]);

        // after submitting the form it does a redirect
        $response->assertStatus(302);

        // get the location of the redirect
        $location = $response->headers->get('Location');

        // go to result page
        $resultRes = $this->get($location);

        // return 200 if the page is success
        $resultRes->assertStatus(200);

        // check if contains the word
        $resultRes->assertSeeText('Car has over 5000 KM and it been over 6 months since your last oil change!!');
    });
});