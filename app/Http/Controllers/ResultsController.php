<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Submission;
use Carbon\Carbon;

// https://laravel.com/docs/12.x/controllers
class ResultsController extends Controller
{

    public function store(Request $request)
    {
        // TODO: I should be able to update car information
        // All fields are required.
        // The current odometer must be greater or equal to the odometer at previous oil change
        // Date of previous oil change must be valid and in the past

        // validate form
        $validated = $request->validate([
            'car_id' => 'required',
        ]);

        // store data into submission table
        $submission = Submission::create([
            'car_id' => $validated['car_id'],
        ]);

        // redirect to results page with the submission id
        return redirect()->route('submission-show', ['id' => $submission->id]);
    }

    public function show($id)
    {
        // get submission row
        $submission = DB::table('submissions')->find($id);

        // get car_id from submission row
        $car = DB::table('cars')->find( $submission->id);

        // check if the car needs an oil change or not
        $message = "Car doesnt need oil change =)";

        // https://laravel.com/docs/12.x/helpers#dates
        $previousOilChangeDate = Carbon::parse($car->previous_oil_change_date);
        $today = Carbon::now();
        $isOver6Month = $previousOilChangeDate->diffInMonths($today) > 6;

        if ($car->current_odometer >= 5000 && $isOver6Month) $message = "need an oil change!!!";

        // return the result view and pass down the submission into the view
        return view('result', [
            'submission' => $submission,
            'car' => $car,
            'message' => $message
        ]);
    }
}
