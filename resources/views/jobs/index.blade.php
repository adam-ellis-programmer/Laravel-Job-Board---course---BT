<x-layout>
  <h1>Avalable Jobs</h1>
  <ul>
    <ul>
      @forelse($jobs as $job)
      @if($loop->first)
      <li>First: {{ $job }}</li>
      @else
      <li>{{ $job }}</li>
      @endif
      @empty
      <li>No Jobs Found</li>
      @endforelse
    </ul>
  </x-layout>
