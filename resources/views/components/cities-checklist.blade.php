@props(['cities'])

<fieldset class="-mx-10 bg-gray-100 border border-dotted border-gray-400 rounded-lg">
  <legend class="sr-only">Cities</legend>
  <div class="my-2 pl-10">
      <div class="grid grid-cols-3">
        @foreach ($cities as $city )
            <x-checkbox :city="$city" :mode="$attributes->get('data-mode')"/>
        @endforeach
      </div>
  </div>
</fieldset>