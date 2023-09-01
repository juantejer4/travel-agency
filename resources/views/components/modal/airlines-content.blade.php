<label for="{{$mode}}-name" class="block text-xs font-medium leading-6 text-gray-900">Name</label>
<div class="mt-2">
    <input required type="text" name="{{$mode}}-name" id="{{$mode}}-name" class="block border-0 focus:ring-2 focus:ring-indigo-600 focus:ring-inset placeholder:text-gray-400 px-3 py-1.5 ring-1 ring-gray-300 ring-inset rounded-md shadow-sm sm:leading-6 sm:text-sm text-gray-900 w-full">
    <p id="{{$mode}}-name-error-message" class="justify-self-end mt-1 text-red-500 text-xs invisible">/</p>
</div>
<label for="{{$mode}}-description" class="block text-xs font-medium leading-6 text-gray-900">Description</label>
<div class="mt-2">
    <div class="mt-2">
        <textarea rows="4" name="{{$mode}}-description" id="{{$mode}}-description" class="px-1.5 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
    </div>
</div>
<label for="cities" class="block text-xs font-medium leading-6 text-gray-900">Operative cities:</label>
<x-cities-checklist data-mode="{{$mode}}" :cities="$cities" />