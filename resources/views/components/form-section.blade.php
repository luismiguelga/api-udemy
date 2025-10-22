<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
  <div class="px-4 sm:px-0">
    <h3 class="text-lg font-medium text-white">{{ $title }}</h3>
    <p class="mt-1 text-sm text-gray-200">{{ $description }}</p>
  </div>

  <div class="mt-5 px-4 sm:px-0 md:col-span-2 md:mt-0">
    <div>
      <div class="rounded-tl-md rounded-tr-md bg-white px-4 py-5 shadow sm:p-6">
        {{ $slot }}
      </div>

      @isset($actions)
        <div class="px-6 py-3 bg-gray-400 shadow flex justify-end items-center rounded-bl-md rounded-br-md">
          {{ $actions }}
        </div>
      @endisset
    </div>
  </div>

</div>
