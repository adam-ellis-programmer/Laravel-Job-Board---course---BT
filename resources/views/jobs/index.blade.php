<x-layout>

  <h1>helo</h1>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

    @forelse($jobs as $job)

    <x-job-card :job="$job" />

    @empty
    <p>No jobs found</p>
    @endforelse
  </div>
  <!-- Pagination Links -->
  <div class="mt-4">{{ $jobs->links() }}</div>
</x-layout>