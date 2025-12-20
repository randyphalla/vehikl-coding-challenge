<x-layout>

  @include('components.header')

  <h1 class="flex justify-center">Welcome to the Vehikl Oil Change Challenge</h1>

  <section>
    {{-- Form errors --}}
    @if ($errors->any())
      <div>
        <ul>
          @foreach ($errors->all() as $error )
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form
      action="{{ route('submission-store') }}"
      method="POST"
    >
      @csrf

      <div>
        <label for="current_odometer">Odometer</label>
        <input
          type="number"
          name="current_odometer"
          class="@error('current_odometer') is-invalid @enderror"
        />
      </div>

      @error('current_odometer')
        <span>{{ $message }}</span>
      @enderror

      <div>
        <label for="previous_oil_change_odometer">Odemeter at Previous Oil Change</label>
        <input
          type="number"
          name="previous_oil_change_odometer"
          class="@error('previous_oil_change_odometer') is-invalid @enderror"
        />
      </div>

      @error('previous_oil_change_odometer')
        <span>{{ $message }}</span>
      @enderror

      <div>
        <label for="previous_oil_change_date">Date of Previous Oil Change</label>
        <input
          type="date"
          name="previous_oil_change_date"
          class="@error('previous_oil_change_date') is-invalid @enderror"
        />
      </div>

        @error('previous_oil_change_date')
        <span>{{ $message }}</span>
      @enderror

      <button>Submit</button>
    </form>
  </section>
</x-layout>