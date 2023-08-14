<x-layout>

  <form id="add-form" action="/cities" method="POST" style="display: flex;" class="justify-end m-5 space-x-1.5 invisible">
    <input type="hidden" name="_token" value="mlI8l5aiI0aFsEs4qkVyIwwiR28fH9rGQOAVifWI"> <label for="name">City name:</label><br>
    <input type="text" id="name" name="name" class="bg-gray-100 border border-dashed"><br>
    <input class="bg-blue-100 hover:bg-blue-300 px-4 py-1 rounded-full" type="submit" value="Add new city">
    <span id="add-city-cancel-button" class="bg-red-300 hover:bg-red-500 px-4 py-1 rounded-full select-none">Cancel</span>
  </form>

  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900 text-xl">Cities</h1>
      </div>
      <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <button id="add-button" type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add city</button>
      </div>
    </div>
    <div class="mt-8 flow-root px-8">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <x-table />
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById("add-button").onclick = function() {
      document.getElementById("add-form").classList.remove("invisible");
      document.getElementById("add-form").classList.add("visible");
    }
    document.getElementById("add-city-cancel-button").onclick = function() {
      document.getElementById("add-form").classList.remove("visible");
      document.getElementById("add-form").classList.add("invisible");
    }
  </script>
</x-layout>