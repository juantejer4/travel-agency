@props(['city', 'mode'])

<div class="flex items-start relative">
    <div class="flex h-6 items-center">
        <input id="{{ $mode }}-{{ $city->name }}" name="{{ $city->name }}" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
    </div>
    <div class="ml-1 mr-10 text-sm leading-6">
        <label for="{{ $mode }}-{{ $city->name }}" class="font-medium text-gray-900 capitalize">{{ $city->name }}</label>
    </div>
</div>
