<header class="flex justify-between mb-6 pb-6 border-b">
  <h1>Vehikl Oil Change</h1>
  <nav class="flex list-none gap-2">
    @if (request()->query('showBack'))
      <li>
        <a href="{{ route('submission-create'); }}">Go Back</a>
      </li>
    @endif
  </nav>
</header>