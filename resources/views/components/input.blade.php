<div>
  @if ($label)
    <div class="mb-1 flex">
        <label for="" class="text-gray-700 font-medium">{{ $label }}</label>
    </div>
  @endif
  <div>
    <input
      {{ $attributes }} 
      type="{{ $type }}"
      class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-2 text-gray-700 placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-300 outline-none transition duration-200"
    >
  </div>
</div>
