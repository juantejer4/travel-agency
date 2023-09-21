<x-layout>

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

    <x-created-flight-toast title="Flight created successfully!" />

    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900 text-xl">Flights</h1>
            </div>

            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button :id="'open-create-modal'">Add flight</x-button>
            </div>
        </div>
        <div id="flights-report"></div>
    </div>

    <script type="module">
        import App from "/components/App.js";

        Vue.createApp(App).mount('#flights-report');
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="/flights.js"></script>

</x-layout>