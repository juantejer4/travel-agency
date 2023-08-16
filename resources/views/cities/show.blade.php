<x-layout>
  <div class="flex justify-end">
    <form id="add-city-form" method="POST" class="grid-cols-4 inline-grid space-x-1.5 invisible">
      <input type="hidden" id="id" name="id">
      <label for="name" class="justify-self-end pt-1">City name:</label>
      <input type="text" id="name" name="name" class="bg-gray-100 border border-dashed pl-1.5">
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
        <button id="add-city-button" type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add city</button>
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
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Arriving Flights</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Departing Flights</th>
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script type="text/javascript">
    document.getElementById("add-city-button").onclick = function() {
      document.getElementById("add-city-form").classList.remove("invisible");
      document.getElementById("add-city-form").classList.add("visible");
    }
    document.getElementById("cancel-button").onclick = function() {
      document.getElementById("add-city-form").classList.remove("visible");
      document.getElementById("add-city-form").classList.add("invisible");
      document.getElementById("error-message").classList.remove("visible");
      document.getElementById("error-message").classList.add("invisible");
      document.getElementById("name").value = "";
    }


    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: 'GET',
        url: 'cities/json' + location.search,
        cache: false,
        processData: false,
        contentType: false,
        success: (cities) => {
          $(".dynamic-tbody").html(generateTableRows(cities.data));
        },
        error: function(data) {
          console.log(data);
        }
      });
    })
    $("#add-city-form").submit(function(e) {
      e.preventDefault();
      var cityData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: "{{ route('cities.store') }}",
        data: cityData,
        cache: false,
        processData: false,
        contentType: false,
        success: (data) => {
          $.ajax({
            type: 'GET',
            url: 'cities/json' + location.search,
            cache: false,
            processData: false,
            contentType: false,
            success: (cities) => {
              $(".dynamic-tbody").html(generateTableRows(cities.data));
            },
            error: function(data) {
              console.log(data);
            }
          });

        },
        error: function(data) {
          $message = data.responseJSON.message;
          document.getElementById("error-message").textContent = $message;
          document.getElementById("error-message").classList.remove("invisible");
          document.getElementById("error-message").classList.add("visible");
        }
      });

    });

    function generateTableRows(response) {
      let rows = "";
      let cities = response.data;

      cities.forEach(function(city) {
        rows += generateRow(city);
      });

      return rows;
    }

    function generateRow(city) {
      return `
              <tr>
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">${city.id}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${city.name}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"> - </td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"> - </td>
                  <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                      <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                  </td>
                  <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                      <a href="#" class="text-red-600 hover:text-red-800">Delete</a>
                  </td>
              </tr>
            `;
    }
  </script>
</x-layout>