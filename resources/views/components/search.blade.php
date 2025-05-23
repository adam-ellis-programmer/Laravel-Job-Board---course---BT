{{-- Get method as search comp --}}
<form method="GET" action="{{ route('jobs.search') }}" class="block mx-5 space-y-2 md:mx-auto md:space-x-2">
    <input type="text" name="keywords" placeholder="Keywords" value="{{request('keywords')}}"
        class="rounded bg-white w-full md:w-72 px-4 py-3 focus:outline-none" />
    <input type="text" name="location" placeholder="Location" value="{{request('location')}}"
        class="rounded bg-white w-full md:w-72 px-4 py-3 focus:outline-none" />
    <button class="rounded w-full md:w-auto bg-blue-700 hover:bg-blue-600 text-white px-4 py-3 focus:outline-none">
        <i class="fa fa-search mr-1"></i> Search
    </button>
</form>