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

  <div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="interestModal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
      <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full sm:mx-0 sm:h-10 sm:w-10">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
              </svg>
            </div>

            <div class="mt-3 text-center sm:mt-0 mx-12 sm:text-left">
              <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                Edit city name
              </h3>
              <div class="mt-2">
                <div>
                  <input type="hidden" id="city-id" name="id"></span>
                  <label for="city-name" class="block text-xs font-medium leading-6 text-gray-900">City name</label>
                  <div class="mt-2">
                    <input type="text" name="city-name" id="city-name" class="block border-0 focus:ring-2 focus:ring-indigo-600 focus:ring-inset placeholder:text-gray-400 px-3 py-1.5 ring-1 ring-gray-300 ring-inset rounded-md shadow-sm sm:leading-6 sm:text-sm text-center text-gray-900 w-full">
                    <p id="error-message-edit" class="col-span-2 justify-self-end mt-1 text-red-500 text-xs invisible">/</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button id="name-update" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
            Save
          </button>
          <button type="button" class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Cancel
          </button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script type="text/javascript">
    $('#add-city-button').click(function() {
      $('#add-city-form').removeClass('invisible').addClass('visible');
    });

    $('#cancel-button').click(function() {
      $('#add-city-form').removeClass('visible').addClass('invisible');
      $('#error-message').removeClass('visible').addClass('invisible');
      $('#name').val('');
    });

    $(document).ready(function() {
      $('.closeModal').on('click', function(e) {
        $('#interestModal').addClass('invisible');
        $('#error-message-edit').removeClass('visible').addClass('invisible');
      });
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
      $(document).on('click', 'button.delete', function() {
        let id = $(this).data('id');
        $.ajax({
          url: "cities/" + id,
          type: 'DELETE',
          data: {
            "id": id,
          },
          success: function() {
            $.ajax({
              type: 'GET',
              url: 'cities/json' + location.search,
              cache: false,
              processData: false,
              contentType: false,
              success: (cities) => {
                $(".dynamic-tbody").html(generateTableRows(cities.data));
              },
            });
          }
        });
      });
      $(document).on('click', 'button.edit', function() {
        let cityName = $(this).parents("tr").find("td:nth-child(2)").text();
        $('#interestModal').removeClass('invisible');
        $('#city-id').val($(this).parents("tr").find("td:nth-child(1)").text());
        $('#city-name').val(cityName);
        $('#city-name').attr("placeholder", cityName);
      });
    })

    $(document).on('click', '#name-update', function() {
      let id = $('#city-id').val();
      var name = $('#city-name').val();

      $.ajax({
        url: 'cities/' + id,
        type: 'PUT',
        data: {
          name: name
        },
        success: function(data) {
          $.ajax({
              type: 'GET',
              url: 'cities/json' + location.search,
              cache: false,
              processData: false,
              contentType: false,
              success: (cities) => {
                $(".dynamic-tbody").html(generateTableRows(cities.data));
              },
            });
          $('#interestModal').addClass('invisible');
          $('#error-message-edit').removeClass('visible').addClass('invisible');
        },
        error: function(data) {
          $message = data.responseJSON.message;
          console.log($message);
          $('#error-message-edit').text($message);
          $('#error-message-edit').removeClass('invisible').addClass('visible');
        }
      });

    });

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
              $('#error-message').removeClass('visible').addClass('invisible');
            },

          });
          $('#name').val('');
        },
        error: function(data) {
          $message = data.responseJSON.message;
          $('#error-message').text($message);
          $('#error-message').removeClass('invisible').addClass('visible');
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
                      <button type="button" data-id="${city.id}"  class="edit text-indigo-600 hover:text-indigo-900">Edit</button>
                  </td>
                  <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                      <button type="button" data-id="${city.id}" class="delete text-red-600 hover:text-red-800">Delete</button>
                  </td>
              </tr>
            `;
    }
  </script>
</x-layout>