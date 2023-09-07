<x-layout>

    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900 text-xl">Flights</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button :id="'open-create-modal'">Add flight</x-button>
            </div>
        </div>
        <div class="mt-8 flow-root px-8">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">

                    <table class="min-w-full divide-y divide-gray-300">
                        <x-table-head :columns="['Id', 'Airline', 'Origin', 'Destination', 'Departure', 'Arrival']" />
                        <tbody class="dynamic-tbody divide-y divide-gray-200">
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <x-modal.box mode="create">
        <x-modal.header title="Create new flight">
            <x-modal.flights-content mode="new" />
        </x-modal.header>
        <x-modal.buttons mode="create" />
    </x-modal.box>
    
    <x-modal.box mode="edit">
        <x-modal.header title="Edit flight">
            <x-modal.flights-content mode="edit" />
        </x-modal.header>
        <x-modal.buttons mode="edit" />
    </x-modal.box>

    <x-delete-modal />

    <div id="toast" class="bg-green-50 bottom-6 fixed p-4 right-8 rounded-md w-1/3 invisible">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">New flight added successfully!</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button id="close-toast" type="button" class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                        <span class="sr-only">Dismiss</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="/flights.js"></script>

</x-layout>