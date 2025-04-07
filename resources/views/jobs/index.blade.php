<x-layout>
  <h1>Avalable Jobs</h1>
  <ul>
    <ul>
      @forElse ($jobs as $job)
      <li>{{$job->title}} -- {{$job->description}} </li>
          @empty
          <li>none found</li>
      @endforElse
    </ul>
  </x-layout>
4