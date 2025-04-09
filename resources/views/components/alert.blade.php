@props(['type', 'message', 'timeOut' => '5000'])

<div
  x-data="{ show: true }"
  x-init="setTimeout(() => show = false, {{$timeOut}})"
  x-show="show"
  class="p-4 mb-4 text-sm text-white {{ $type === 'success' ? 'bg-green-500' : 'bg-red-500' }} rounded">
    {{-- {{ session($type) }} --}}
    {{$message}}
</div>