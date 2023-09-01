<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
    <div class="sm:flex sm:items-start">
        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full sm:mx-0 sm:h-10 sm:w-10">
            <x-write-icon />
        </div>
        <div class="mt-3 text-center sm:mt-0 mx-12 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                {{$title}}
            </h3>
            <div class="mt-2">
                <div>
                    <input type="hidden" id="id" name="id"></span>
                    {{$slot}}
                </div>
            </div>
        </div>

    </div>
</div>