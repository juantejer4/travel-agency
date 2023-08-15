
<table class="min-w-full divide-y divide-gray-300">
  <thead>
    <tr>
      <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Id</th>
      <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
      <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Flights</th>
      <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
        <span class="sr-only">Edit</span>
      </th>
    </tr>
  </thead>
  <tbody class="divide-y divide-gray-200">
    {{ $slot }}
  </tbody>
</table>