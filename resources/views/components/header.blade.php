@php
// echo 'Hello, World!';
// $isActive = request()->is('jobs');
// echo $isActive ? 'active' : '';
@endphp

{{-- open state goes to parent of button --}}
<header class="bg-blue-900 text-white p-4" x-data="{ open: false }">

  <div class="container mx-auto flex justify-between items-center">
    <h1 class="text-3xl font-semibold">
      <a href="{{ url('/') }}">Workopia</a>
    </h1>


    {{-- <x-nav-link url="/" :active="request()->is('/')">Home</x-nav-link> --}}

    <nav class="hidden md:flex items-center space-x-4">
      <x-nav-link url="/" :active="request()->is('/')">Home</x-nav-link>
      <x-nav-link url="/jobs" :active="request()->is('jobs')">All Jobs</x-nav-link>
      @auth
      {{-- start auth --}}
      <x-nav-link url="/jobs/saved" :active="request()->is('jobs/saved')">Saved Jobs</x-nav-link>
      <x-nav-link url="/profile" :active="request()->is('profile')"></i> Profile </x-nav-link>
      <x-nav-link url="/dashboard" :active="request()->is('dashboard')" icon="gauge">Dashboard</x-nav-link>
      <x-logout-form-btn />
      <x-button-link url="/jobs/create" textClass="text-white" icon="edit">Create Job</x-button-link>

      {{-- end auth --}}
      @else
      <x-nav-link url="/login" :active="request()->is('login')" icon='user'>Login</x-nav-link>
      <x-nav-link url="/register" :active="request()->is('register')">Register</x-nav-link>
      @endAuth
    </nav>

    <button @click="open = !open" class="text-white md:hidden flex items-center">
      <i class="fa fa-bars text-2xl"></i>
    </button>
  </div>

  <!-- Mobile Menu -->
  <nav id="mobile-menu" class="md:hidden bg-blue-900 text-white mt-5 pb-4 space-y-2" x-show="open"
    @click.away="open = false">
    @auth
    <x-nav-link url="/jobs/saved" :active="request()->is('jobs/saved')" :mobile="true">Saved Jobs</x-nav-link>
    <x-nav-link url="/dashboard" :active="request()->is('dashboard')" :mobile="true">Dashbaord</x-nav-link>
    <x-nav-link url="/jobs" :active="request()->is('jobs')" :mobile="true">All Jobs</x-nav-link>
    {{-- button link --}}
    <div class="pt-2 pb-1">
      <x-logout-form-btn />
    </div>
    <x-button-link url="/jobs/create" textClass="text-white" icon="edit" :block='true'>Create Job</x-button-link>
    @else
    <x-nav-link url="/jobs" :active="request()->is('jobs')" :mobile="true">All Jobs</x-nav-link>
    <x-nav-link url="/register" :active="request()->is('register')" :mobile="true">Register</x-nav-link>
    <x-nav-link url="/login" :active="request()->is('login')" :mobile="true">Login</x-nav-link>
    @endAuth
  </nav>
</header>