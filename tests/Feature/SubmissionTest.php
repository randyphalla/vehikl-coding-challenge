<?php

use Carbon\Carbon;
use App\Models\Submission;

test('visit form page', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
    // $response->dump();
    // $response->dumpHeaders();
    // $response->dumpSession();
    // $response->dd();
    // $response->ddHeaders();
    // $response->ddBody();
    // $response->ddJson();
    // $response->ddSession();
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
    $currentOdometer = 4000;
    $previousOilChangeOdometer = 3000;
    $previousOilChangeDate = Carbon::parse('2025-12-23 00:00:00');

    $formData = [
        'current_odometer' => $currentOdometer,
        'previous_oil_change_odometer' => $previousOilChangeOdometer,
        'previous_oil_change_date' => $previousOilChangeDate,
    ];

    expect($currentOdometer)->toBeInt()->toBe(4000);

    expect($currentOdometer)->toBeGreaterThan($previousOilChangeOdometer);

    expect($previousOilChangeOdometer)->toBeInt()->toBe(3000);

    expect($currentOdometer)->not->toBeLessThan($previousOilChangeOdometer);

    expect($previousOilChangeDate) ->toDateTimeString()->toBe('2025-12-23 00:00:00');

    $this->post('/check', $formData)->assertStatus(302);
});

test('submit form: when current_odometer is over 5000 km', function () {
    $currentOdometer = 6000;
    $previousOilChangeOdometer = 3000;
    $previousOilChangeDate = Carbon::parse('2025-12-23 00:00:00');

    $formData = [
        'current_odometer' => $currentOdometer,
        'previous_oil_change_odometer' => $previousOilChangeOdometer,
        'previous_oil_change_date' => $previousOilChangeDate,
    ];

    expect($currentOdometer)->toBeInt()->toBe(6000);

    expect($currentOdometer)->toBeGreaterThan(5000);

    expect($currentOdometer)->toBeGreaterThan($previousOilChangeOdometer);

    expect($currentOdometer)->not->toBeLessThan($previousOilChangeOdometer);

    expect($previousOilChangeDate)->toDateTimeString()->toBe('2025-12-23 00:00:00');

    $this->post('/check', $formData)->assertStatus(302);
});

///////////////////////////////////////////
// Testing: previous_oil_change_odometer
///////////////////////////////////////////
test('submit form: when current_odometer is less than previous_oil_change_odometer', function () {
    $currentOdometer = 3000;
    $previousOilChangeOdometer = 4000;
    $previousOilChangeDate = Carbon::parse('2025-12-23 00:00:00');

    $formData = [
        'current_odometer' => $currentOdometer,
        'previous_oil_change_odometer' => $previousOilChangeOdometer,
        'previous_oil_change_date' => $previousOilChangeDate,
    ];

    expect($currentOdometer)->toBeInt()->toBe(3000);

    expect($currentOdometer)->toBeLessThanOrEqual(5000);

    expect($currentOdometer)->toBeLessThan($previousOilChangeOdometer);

    expect($previousOilChangeDate)->toDateTimeString()->toBe('2025-12-23 00:00:00');

    $this->followingRedirects()
        ->post('/check', $formData)
        ->assertSee(['current_odometer']);
});

///////////////////////////////////////////
// Testing: previous_oil_change_date field
///////////////////////////////////////////
test('submit form: when previous_oil_change_date is today', function () {
    $currentOdometer = 4000;
    $previousOilChangeOdometer = 3000;
    Carbon::setTestNow('2025-12-24');
    $previousOilChangeDate = Carbon::now();

    $formData = [
        'current_odometer' => $currentOdometer,
        'previous_oil_change_odometer' => $previousOilChangeOdometer,
        'previous_oil_change_date' => $previousOilChangeDate,
    ];

    expect($currentOdometer)->toBeInt()->toBe(4000);

    expect($currentOdometer)->toBeLessThanOrEqual(5000);

    expect($currentOdometer)->toBeGreaterThanOrEqual($previousOilChangeOdometer);

    expect($previousOilChangeDate->toDateString())->toBe('2025-12-24');

    $this->post('/check', $formData)
        ->assertStatus(302)
        ->assertSessionHasErrors(['previous_oil_change_date']);
});

test('submit form: when previous_oil_change_date is past', function () {
    $currentOdometer = 4000;
    $previousOilChangeOdometer = 3000;
    $previousOilChangeDate = Carbon::parse('2025-12-23 00:00:00');

    $formData = [
        'current_odometer' => $currentOdometer,
        'previous_oil_change_odometer' => $previousOilChangeOdometer,
        'previous_oil_change_date' => $previousOilChangeDate,
    ];

    expect($currentOdometer)->toBeInt()->toBe(4000);

    expect($currentOdometer)->toBeLessThanOrEqual(5000);

    expect($currentOdometer)->toBeGreaterThanOrEqual($previousOilChangeOdometer);

    expect($previousOilChangeDate)->toDateTimeString()->toBe('2025-12-23 00:00:00');

    $this->post('/check', $formData)->assertStatus(302);
});

test('submit form: when previous_oil_change_date is over 6 months', function () {
    $currentOdometer = 4000;
    $previousOilChangeOdometer = 3000;
    $previousOilChangeDate = Carbon::parse('2025-01-23 00:00:00');

    $formData = [
        'current_odometer' => $currentOdometer,
        'previous_oil_change_odometer' => $previousOilChangeOdometer,
        'previous_oil_change_date' => $previousOilChangeDate,
    ];

    expect($currentOdometer)->toBeInt()->toBe(4000);

    expect($currentOdometer)->toBeLessThanOrEqual(5000);

    expect($currentOdometer)->toBeGreaterThanOrEqual($previousOilChangeOdometer);

    expect($previousOilChangeDate)->toDateTimeString()->toBe('2025-01-23 00:00:00');

    $this->post('/check', $formData)->assertStatus(302);
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
describe('submission success and visit result page with id', function () {
    test('submit form', function() {
        $submission = Submission::factory()
            ->odometerIsLessThan5KM()
            ->create();

        expect($submission->current_odometer)
            ->toBeInt()
            ->toBe(4000);

        expect($submission->current_odometer)
            ->toBeInt()
            ->toBeLessThanOrEqual(5000);

        expect($submission->current_odometer)
            ->toBeInt()
            ->toBeGreaterThanOrEqual($submission->previous_oil_change_odometer);

        expect($submission->previous_oil_change_odometer)
            ->toBeInt()
            ->toBe(3000);

        // create a submission item and submit data to to "/check"
        $response = $this->post('/check', $submission->toArray());

        // after submitting the form it does a redirect
        $response->assertStatus(302);

        // get the location of the redirect
        $location = $response->headers->get('Location');

        // go to result page
        $resultRes = $this->get($location);

        // return 200 if the page is success
        $resultRes->assertStatus(200);
    });
});

describe('submission success and car doesnt need oil change', function () {
    test('submit form', function() {
        $submission = Submission::factory()
            ->odometerIsLessThan5KM()
            ->create();

        expect($submission->current_odometer)
            ->toBeInt()
            ->toBe(4000);

        expect($submission->current_odometer)
            ->toBeInt()
            ->toBeLessThanOrEqual(5000);

        expect($submission->current_odometer)
            ->toBeInt()
            ->toBeGreaterThanOrEqual($submission->previous_oil_change_odometer);

        expect($submission->previous_oil_change_odometer)
            ->toBeInt()
            ->toBe(3000);

        // create a submission item and submit data to to "/check"
        $response = $this->post('/check', $submission->toArray());

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

describe('submission success and car has over 5000km', function () {
    test('submit form', function() {
        $submission = Submission::factory()
            ->odometerIsOver5KM()
            ->create();

        expect($submission->current_odometer)
            ->toBeInt()
            ->toBe(8000);

        expect($submission->current_odometer)
            ->toBeInt()
            ->toBeGreaterThanOrEqual(5000);

        expect($submission->current_odometer)
            ->toBeInt()
            ->toBeGreaterThanOrEqual($submission->previous_oil_change_odometer);

        expect($submission->previous_oil_change_odometer)
            ->toBeInt()
            ->toBe(4000);

        // create a submission item and submit data to to "/check"
        $response = $this->post('/check', $submission->toArray());

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

describe('submission success and hasnt changed their oil over 6 months', function () {
    test('submit form', function() {
        $submission = Submission::factory()
            ->overSixMonths()
            ->create();

        expect($submission->current_odometer)
            ->toBeInt()
            ->toBe(4000);

        expect($submission->current_odometer)
            ->toBeInt()
            ->toBeLessThanOrEqual(5000);

        expect($submission->current_odometer)
            ->toBeInt()
            ->toBeGreaterThanOrEqual($submission->previous_oil_change_odometer);

        expect($submission->previous_oil_change_odometer)
            ->toBeInt()
            ->toBe(3000);

        // create a submission item and submit data to to "/check"
        $response = $this->post('/check', $submission->toArray());

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

describe('submission success, car has over 5000km and hasnt changed their oil over 6 months', function () {
    test('submit form', function() {
        $submission = Submission::factory()
            ->needsOilChange()
            ->create();

        expect($submission->current_odometer)
            ->toBeInt()
            ->toBe(8000);

        expect($submission->current_odometer)
            ->toBeInt()
            ->toBeGreaterThanOrEqual(5000);

        expect($submission->current_odometer)
            ->toBeInt()
            ->toBeGreaterThanOrEqual($submission->previous_oil_change_odometer);

        expect($submission->previous_oil_change_odometer)
            ->toBeInt()
            ->toBe(4000);

        // create a submission item and submit data to to "/check"
        $response = $this->post('/check', $submission->toArray());

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