<x-layout>
  <h1>Avalable Jobs</h1>
  <ul>
    <ul>
      @forElse ($jobs as $job)
      <li>
        
        {{-- url OR route helper --}}
        {{-- unless in a nav use route helper --}}
        <a href="{{ route('jobs.show', $job->id) }}">
          {{ $job->title }}
        </a>
          @empty
          <li>none found</li>
      @endforElse
    </ul>
  </x-layout>

