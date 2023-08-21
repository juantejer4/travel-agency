<x-layout>
  <div class="flex justify-end">
    <form id="add-airline-form" method="POST" class="grid-cols-4 inline-grid space-x-1.5 invisible">
      <input type="hidden" id="id" name="id">
      <label for="name" class="justify-self-end pt-1">Airline name:</label>
      <input required type="text" id="name" name="name" class="bg-gray-100 border border-dashed pl-1.5">
      <button class="bg-blue-100 hover:bg-blue-300 px-4 py-1 rounded-full" type="submit">Add new airline</button>
      <button type="button" id="cancel-button" class="bg-red-300 hover:bg-red-500 px-4 py-1 rounded-full select-none">Cancel</button>
      <p id="error-message" class="col-span-2 justify-self-end mt-1 px-8 text-red-500 text-xs invisible">/</p>
    </form>
  </div>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900 text-xl">Airlines</h1>
      </div>
      <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <button id="add-airline-button" type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add airline</button>
      </div>
    </div>
    <div class="mt-8 flow-root px-8">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">

          <table class="min-w-full divide-y divide-gray-300">
            <thead>
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Id</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Flights</th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
            </thead>
            <tbody class="dynamic-tbody divide-y divide-gray-200">
            </tbody>
          </table>

          <footer class="p-10">
            {!! $links !!}
          </footer>

        </div>
      </div>
    </div>
  </div>

  <script src="/airlines.js"></script>

</x-layout>