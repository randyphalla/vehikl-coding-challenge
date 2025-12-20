<x-layout>

  @include('components.header')

  <section>
    <form
      action="{{ route('submission-check') }}"
      method="POST"
    >
      @csrf

      <input type="hidden" name="car_id" value={{ $car['id'] }} />

      <div>
        <label for="name">Name</label>
        <input type="text" name="name" readonly value={{$car['name']}} />
      </div>

      <div>
        <label for="current_odometer">Odometer</label>
        <input
          type="number"
          name="current_odometer"
          value={{$car['current_odometer']}}
        />
      </div>

      <div>
        <label for="previous_oil_change_odometer">Odemeter at Previous Oil Change</label>
        <input
          type="number"
          name="previous_oil_change_odometer"
          value={{$car['previous_oil_change_odometer']}}
        />
      </div>

      <div>
        <label for="previous_oil_change_date">Date of Previous Oil Change</label>
        <input
          type="date"
          name="previous_oil_change_date"
          value={{$car['previous_oil_change_date']}}
        />
      </div>

      <button>Submit</button>
    </form>
  </section>
</x-layout>