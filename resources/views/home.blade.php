<x-layout>
  @include('components.header')

  <h1 class="">Welcome to the Vehikl Oil Change Challenge</h1>

  <ul>
    @foreach ($cars as $car)
      <li>
        <a href="/cars/{{ $car['id'] }}">
          {{ $car['name'] }}
        </a>
      </li>
     @endforeach
  </ul>

</x-layout>