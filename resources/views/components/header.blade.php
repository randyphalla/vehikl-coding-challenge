<header class="flex justify-between mb-6 pb-6 border-b">
  <h1 class="text-center text-2xl font-bold tracking-tight text-gray-900">Vehikl Oil Change</h1>
  <nav class="flex list-none gap-2">
    @if (request()->query('showBack'))
      <li>
        <a href="{{ route('submission-create'); }}" class="font-medium text-lg tracking-tight text-grey-900">Go Back</a>
      </li>
    @endif
  </nav>
</header>