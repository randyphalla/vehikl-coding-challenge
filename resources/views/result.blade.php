<x-layout>

    <h1 class="">{{ $message }}</h1>

  <div>
    <h2>Car Information</h2>
    <p>Name: {{ $car->name }}</p>
    <p>Current Odometer{{ $car->current_odometer }}</p>
    <p>Previous Oil Change Odometer: {{ $car->previous_oil_change_odometer }}</p>
    <p>Previous Oil Change Date: {{ $car->previous_oil_change_date }}</p>
  </div>

</x-layout>