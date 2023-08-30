@props(['airline'])

<tr>
    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ $airline->id }}</td>
    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $airline->name }}</td>
    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"> {{ $airline->description !== null ? $airline->description : '-' }} </td>
    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"> - </td>
    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
    </td>
    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
        <a href="#" class="text-red-600 hover:text-red-800">Delete</a>
    </td>
</tr>