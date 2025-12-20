<x-layout>
  @include('components.header')

  <div class="flex justify-center items-center flex-col">

    <h1 class="text-2xl font-bold tracking-tight text-gray-90">{{ $message }}</h1>

    <div class="mt-5 text-left">
      <p class="text-base font-medium text-gray-900">Current Odometer: <span class="font-bold">{{ $submission->current_odometer }}</span></p>
      <p class="text-base font-medium text-gray-900">Previous Oil Change Odometer: <span class="font-bold">{{ $submission->previous_oil_change_odometer }}</span></p>
      <p class="text-base font-medium text-gray-900">Previous Oil Change Date: <span class="font-bold">{{ $submission->previous_oil_change_date }}</span></p>
    </div>
  </div>

</x-layout>