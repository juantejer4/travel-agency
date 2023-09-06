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
            <x-modal.flights-content />
        </x-modal.header>
        <x-modal.buttons mode="create" />
    </x-modal.box>
    
    <x-modal.box mode="edit">
        <x-modal.header title="Edit flight">
            <x-modal.flights-content />
        </x-modal.header>
        <x-modal.buttons mode="edit" />
    </x-modal.box>

    <x-delete-modal />

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="/flights.js"></script>

</x-layout>