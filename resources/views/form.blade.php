<x-layout>

  @include('components.header')

  <section>
    <form>

      <div>
        <label for="name">Name</label>
        <input type="text" name="name" readonly />
      </div>

      <div>
        <label for="current_odometer">Odometer</label>
        <input type="number" name="current_odometer" required />
      </div>

      <div>
        <label for="previous_oil_change_date">Date of Previous Oil Change</label>
        <input type="date" name="previous_oil_change_date" required />
      </div>

      <div>
        <label for="previous_oil_change_odometer">Odemeter at Previous Oil Change</label>
        <input type="number" name="previous_oil_change_odometer" required />
      </div>

      <button>Submit</button>
    </form>
  </section>
</x-layout>