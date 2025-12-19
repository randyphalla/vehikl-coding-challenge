<x-layout>

  @include('components.header')

  <section>
    <form>

      <div>
        <label>Odometer</label>
        <input type="text" name="current-odemeter" required />
      </div>

      <div>
        <label>Date of Previous Oil Change</label>
        <input type="date" name="date" required />
      </div>

      <div>
        <label>Odemeter at Previous Oil Change</label>
        <input type="date" name="odemeter" required />
      </div>

      <button>Submit</button>
    </form>
  </section>
</x-layout>