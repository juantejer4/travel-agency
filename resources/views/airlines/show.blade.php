<x-layout>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900 text-xl">Airlines</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button :id="'open-create-modal'">Add airline</x-button>
            </div>
        </div>
        <div class="mt-8 flow-root px-8">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">

                    <table class="min-w-full divide-y divide-gray-300">
                        <x-table-head :columns="['Id', 'Name', 'Description', 'Flights']" />
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

    <x-modal.box mode="create">
        <x-modal.header title="Create new airline">
            <x-modal.airlines-content mode="new" :cities="$cities" />
        </x-modal.header>
        <x-modal.buttons mode="create" />
    </x-modal.box>

    <x-modal.box mode="edit">
        <x-modal.header title="Edit airline">
            <x-modal.airlines-content mode="edit" :cities="$cities" />
            </x-modal-header>
            <x-modal.buttons mode="edit" />
    </x-modal.box>

    <script src="/airlines.js"></script>

</x-layout>