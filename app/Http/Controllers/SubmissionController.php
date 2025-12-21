<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Submission;
use Carbon\Carbon;
use App\Http\Requests\SubmissionStoreRequest;
use Illuminate\Http\RedirectResponse;

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

    public function store(SubmissionStoreRequest $request): RedirectResponse
    {
        // validate form
        $validated = $request->validated();

        // store data into submission table
        $currentOdometer = $validated['current_odometer'];
        $previousOilChangeDate = $validated['previous_oil_change_date'];
        $previousOilChangeOdometer = $validated['previous_oil_change_odometer'];

        $submission = Submission::create([
            'current_odometer' => $currentOdometer,
            'previous_oil_change_date' =>  $previousOilChangeDate,
            'previous_oil_change_odometer' => $previousOilChangeOdometer,
        ]);

        // redirect to results page with the submission id and show back link
        return redirect()->route('submission-show', ['id' => $submission->id, 'showBack' => true]);
    }

    public function show($id)
    {
        // get submission row
        // $submission = DB::table('submissions')->find($id);
        $submission = Submission::where('id', $id)->first();

        $currentOdometer = $submission->current_odometer;

        // check if the car needs an oil change or not
        $message = "Your car doesn't need an oil change!!";

        $previousOilChangeDate = $submission->previous_oil_change_date;
        $previousOilChangeDateParse = Carbon::parse($previousOilChangeDate);
        $today = Carbon::now();
        $isOver6Month = $previousOilChangeDateParse->diffInMonths($today) > 6;

        if ($currentOdometer >= 5000 && $isOver6Month) {
            $message = "Car has over 5000 KM and it been over 6 months since your last oil change!!";
        } else if ($currentOdometer >= 5000) {
            $message = "Car has over 5000 KM, time to get an oil change!!";
        } else if ($isOver6Month) {
            $message = "It been over 6 months since your last oil change!!";
        }

        // return the result view and pass down the submission into the view
        return view('result', [
            'submission' => $submission,
            'message' => $message,
        ]);
    }
}
