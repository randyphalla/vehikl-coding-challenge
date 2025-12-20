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

    // TODO: look into custom form validation
    // https://laravel.com/docs/12.x/validation#validation-error-response-format
    public function store(Request $request)
    {
        // validate form
        $validated = $request->validate([
            'current_odometer' => 'required|integer|gte:previous_oil_change_odometer',
            'previous_oil_change_date' => 'required|date|before:today',
            'previous_oil_change_odometer' => 'required|integer',
        ]);

        // store data into submission table
        $current_odometer = $validated['current_odometer'];
        $previous_oil_change_date = $validated['previous_oil_change_date'];
        $previous_oil_change_odometer = $validated['previous_oil_change_odometer'];

        $submission = Submission::create([
            'current_odometer' => $current_odometer,
            'previous_oil_change_date' =>  $previous_oil_change_date,
            'previous_oil_change_odometer' => $previous_oil_change_odometer,
        ]);

        // redirect to results page with the submission id and show back link
        return redirect()->route('submission-show', ['id' => $submission->id, 'showBack' => true]);
    }

    public function show($id)
    {
        // get submission row
        $submission = DB::table('submissions')->find($id);
        $currentOdometer = $submission->current_odometer;

        // check if the car needs an oil change or not
        $message = "Car doesnt need an oil change";

        // https://laravel.com/docs/12.x/helpers#dates
        $previousOilChangeDate = $submission->previous_oil_change_date;
        $previousOilChangeDateParse = Carbon::parse($previousOilChangeDate);
        $today = Carbon::now();
        $isOver6Month = $previousOilChangeDateParse->diffInMonths($today) > 6;

        if ($currentOdometer >= 5000 || $isOver6Month) $message = "Car need's an oil change!";

        // return the result view and pass down the submission into the view
        return view('result', [
            'submission' => $submission,
            'message' => $message,
        ]);
    }
}
