<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Submission;
use Carbon\Carbon;

// https://laravel.com/docs/12.x/controllers
class SubmissionController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function create()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        // validate form
        $validated = $request->validate([
            // 'car_id' => 'required',
            'current_odometer' => 'required|integer|gte:previous_oil_change_odometer',
            'previous_oil_change_date' => 'required|date|before:today',
            'previous_oil_change_odometer' => 'required|integer',
        ]);

        // store data into submission table
        $submission = Submission::create([
            // 'car_id' => $validated['car_id'],
            'current_odometer' => $validated['current_odometer'],
            'previous_oil_change_date' => $validated['previous_oil_change_date'],
            'previous_oil_change_odometer' => $validated['previous_oil_change_odometer'],
        ]);

        // redirect to results page with the submission id
        return redirect()->route('submission-show', ['id' => $submission->id, 'showBack' => true]);
    }

    public function show($id)
    {
        // get submission row
        $submission = DB::table('submissions')->find($id);

        // get car_id from submission row
        // $car = DB::table('cars')->find($submission->car_id);

        // check if the car needs an oil change or not
        $message = "Car doesnt need oil change =)";

        // https://laravel.com/docs/12.x/helpers#dates
        // $previousOilChangeDate = Carbon::parse($car->previous_oil_change_date);
        $previousOilChangeDate = Carbon::parse($submission->previous_oil_change_date);
        $today = Carbon::now();
        $isOver6Month = $previousOilChangeDate->diffInMonths($today) > 6;

        // if ($car->current_odometer >= 5000 && $isOver6Month) $message = "need an oil change!!!";
        if ($submission->current_odometer >= 5000 || $isOver6Month) $message = "need an oil change!!!";

        // return the result view and pass down the submission into the view
        return view('result', [
            'submission' => $submission,
            // 'car' => $car,
            'message' => $message,
        ]);
    }
}
