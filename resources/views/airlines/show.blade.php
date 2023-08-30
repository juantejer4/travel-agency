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

    <form id="create-airline-form" method="POST" action="api/airlines">
        <div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="create-modal" role="dialog" aria-modal="true" id="create-modal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                <x-write-icon/>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 mx-12 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Create new airline
                                </h3>
                                <div class="mt-2">
                                    <div>
                                        <input type="hidden" id="id" name="id"></span>
                                        <label for="new-name" class="block text-xs font-medium leading-6 text-gray-900">Name</label>
                                        <div class="mt-2">
                                            <input required type="text" name="new-name" id="new-name" class="block border-0 focus:ring-2 focus:ring-indigo-600 focus:ring-inset placeholder:text-gray-400 px-3 py-1.5 ring-1 ring-gray-300 ring-inset rounded-md shadow-sm sm:leading-6 sm:text-sm text-center text-gray-900 w-full">
                                            <p id="new-name-error-message" class="justify-self-end mt-1 text-center text-red-500 text-xs invisible">/</p>
                                        </div>
                                        <label for="new-description" class="block text-xs font-medium leading-6 text-gray-900">Description</label>
                                        <div class="mt-2">
                                            <div class="mt-2">
                                                <textarea rows="4" name="new-description" id="new-description" class="px-1.5 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                            </div>
                                        </div>
                                        <label for="cities" class="block text-xs font-medium leading-6 text-gray-900">Operative cities:</label>
                                        <x-cities-checklist data-mode="create" :cities="$cities" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button id="add-airline-button" type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Add
                        </button>
                        <button type="button" id="cancel-create-button" class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="edit-airline-form" method="PUT" action="api/airlines">
        <div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="edit-modal" role="dialog" aria-modal="true" id="edit-modal">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                <x-write-icon/>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 mx-12 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Edit airline
                                </h3>
                                <div class="mt-2">
                                    <div>
                                        <input type="hidden" id="id" name="id"></span>
                                        <label for="edit-name" class="block text-xs font-medium leading-6 text-gray-900">Name</label>
                                        <div class="mt-2">
                                            <input required type="text" name="edit-name" id="edit-name" class="block border-0 focus:ring-2 focus:ring-indigo-600 focus:ring-inset placeholder:text-gray-400 px-3 py-1.5 ring-1 ring-gray-300 ring-inset rounded-md shadow-sm sm:leading-6 sm:text-sm text-gray-900 w-full">
                                            <p id="edit-name-error-message" class="justify-self-end mt-1 text-red-500 text-xs invisible">/</p>
                                        </div>
                                        <label for="edit-description" class="block text-xs font-medium leading-6 text-gray-900">Description</label>
                                        <div class="mt-2">
                                            <div class="mt-2">
                                                <textarea rows="4" name="edit-description" id="edit-description" class="px-1.5 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                            </div>
                                        </div>
                                        <label for="cities" class="block text-xs font-medium leading-6 text-gray-900">Operative cities:</label>
                                        <x-cities-checklist data-mode="edit" :cities="$cities" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button id="add-airline-button" type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Edit
                        </button>
                        <button type="button" id="cancel-edit-button" class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="/airlines.js"></script>

</x-layout>