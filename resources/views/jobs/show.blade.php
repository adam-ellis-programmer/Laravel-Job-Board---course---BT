{{-- @extends('layout')
@section('content')
<h1>show job </h1>

<h1>show job {{$id}}</h1>
@endSection --}}


<x-layout>
    <h1 class='text-3xl'>{{ $job->title }}</h1>
    <p>{{ $job->description }}</p>
  </x-layout>