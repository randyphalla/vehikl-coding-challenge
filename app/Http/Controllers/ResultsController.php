<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;

// https://laravel.com/docs/12.x/controllers
class ResultsController extends Controller
{

    public function store(Request $request)
    {
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
        $submission = "";

        // get car_id from submission row

        // check if the car needs an oil change or not
        $message = "need an oil change!!!";

        // return the result view and pass down the submission into the view
        return view('result', ['submission' => $submission, 'message' => $message]);
    }

    // public function index() {}

    // public function create() {}

    // public function edit($id) {}

    // public function update($id) {}

    // public function delete($id) {}
}
