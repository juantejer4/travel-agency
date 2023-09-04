<x-layout>
  <div class="flex justify-end">
    <form id="add-city-form" method="POST" class="grid-cols-4 inline-grid space-x-1.5 invisible">
      <input type="hidden" id="id" name="id">
      <label for="name" class="justify-self-end pt-1">City name:</label>
      <input required type="text" id="name" name="name" class="bg-gray-100 border border-dashed pl-1.5">
      <button class="bg-blue-100 hover:bg-blue-300 px-4 py-1 rounded-full" type="submit">Add new city</button>
      <button type="button" id="cancel-button" class="bg-red-300 hover:bg-red-500 px-4 py-1 rounded-full select-none">Cancel</button>
      <p id="error-message" class="col-span-2 justify-self-end mt-1 px-8 text-red-500 text-xs invisible">/</p>
    </form>
  </div>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900 text-xl">Cities</h1>
      </div>
      <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <x-button :id="'create-city'">Add city</x-button>
      </div>
    </div>
    <div class="mt-8 flow-root px-8">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">

          <table class="min-w-full divide-y divide-gray-300">
            <x-table-head :columns="['Id', 'Name', 'Arriving Flights', 'Departing Flights']" />
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

  <x-modal />

  <script src="/cities.js"></script>
</x-layout>