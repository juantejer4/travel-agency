@props(['columns'])

<thead>
    <tr>
        @foreach ($columns as $column)
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ $column }}</th>
        @endforeach
        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
            <span class="sr-only">Edit</span>
        </th>
    </tr>
</thead>
