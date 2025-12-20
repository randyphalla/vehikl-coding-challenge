<x-layout>

  @include('components.header')

  <h1 class="flex justify-center mt-10 text-2xl font-bold tracking-tight text-gray-900">Welcome to the Vehikl Oil Change Challenge</h1>

  <section class="">
    {{-- Form errors --}}
    {{-- @if ($errors->any())
      <div>
        <ul>
          @foreach ($errors->all() as $error )
            <li class="block mt-2 text-sm text-red-600">{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif --}}

    <form
      action="{{ route('submission-store') }}"
      method="POST"
    >
      @csrf

      <div class="w-full md:max-w-lg lg:max-w-md mx-auto">
        <div class="mt-5">
          <label for="current_odometer" class="block text-sm font-medium text-gray-900">Odometer</label>
          <input
            type="number"
            name="current_odometer"
            class="@error('current_odometer') border border-red-600 @enderror block w-full rounded-md bg-back mt-2 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-black/5 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm"
          />
        </div>

        @error('current_odometer')
          <span class="block mt-2 text-sm text-red-600">{{ $message }}</span>
        @enderror

        <div class="mt-5">
          <label for="previous_oil_change_odometer" class="block text-sm font-medium text-gray-900">Odemeter at Previous Oil Change</label>
          <input
            type="number"
            name="previous_oil_change_odometer"
            class="@error('previous_oil_change_odometer') border border-red-600 @enderror block w-full rounded-md bg-back mt-2 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-black/5 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm"
          />
        </div>

        @error('previous_oil_change_odometer')
          <span class="block mt-2 text-sm text-red-600">{{ $message }}</span>
        @enderror

        <div class="mt-5">
          <label for="previous_oil_change_date" class="block text-sm font-medium text-gray-900">Date of Previous Oil Change</label>
          <input
            type="date"
            name="previous_oil_change_date"
            class="@error('previous_oil_change_date') border border-red-600 @enderror block w-full rounded-md bg-back mt-2 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-black/5 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm"
          />
        </div>

        @error('previous_oil_change_date')
          <span class="block mt-2 text-sm text-red-600">{{ $message }}</span>
        @enderror

        <div class="mt-5 flex gap-2">
          <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500k">Submit</button>
        </div>
      </div>
    </form>
  </section>
</x-layout>