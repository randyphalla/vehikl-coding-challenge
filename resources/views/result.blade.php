<x-layout>
  @include('components.header')

  <h1 class="">{{ $message }}</h1>

  <div>
    <h2>Car Information</h2>
    <p>Current Odometer: {{ $submission->current_odometer }}</p>
    <p>Previous Oil Change Odometer: {{ $submission->previous_oil_change_odometer }}</p>
    <p>Previous Oil Change Date: {{ $submission->previous_oil_change_date }}</p>
  </div>

</x-layout>