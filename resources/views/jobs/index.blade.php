<x-layout>

  <div class="bg-blue-900 p-8 mb-4 flex justify-center items-center rounded">
    <x-search />
  </div>

  <!-- Back Button if we searched -->
  @if(request()->has('keywords') || request()->has('location'))
  <a href="{{ route('jobs.index') }}"
    class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded mb-4 inline-block">
    <i class="fa fa-arrow-left mr-1"></i> Back
  </a>
  @endif

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