<div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
    <div class="space-y-6 sm:space-y-5">
        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                Name
            </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <input type="text"
                       name="name"
                       id="name"
                       class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
                       value="{{ $collection->name }}"
                >
            </div>
        </div>

        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="acronym" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                Acronym
            </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <input id="acronym"
                       name="acronym"
                       type="text"
                       class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                       value="{{ $collection->acronym }}"
                >
            </div>
        </div>

        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <div>
                <div class="text-base font-medium text-gray-900 sm:text-sm sm:text-gray-700" id="label-email">
                    Auto Calculate
                </div>
            </div>
            <div class="mt-4 sm:mt-0 sm:col-span-2">
                <div class="max-w-lg space-y-4">
                    <div class="relative flex items-start">
                        <div class="flex items-center h-5">
                            <input id="auto_calculate"
                                   name="auto_calculate"
                                   type="checkbox"
                                   value="1"
                                   @if($collection->auto_calculate) checked="checked" @endif
                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="auto_calculate" class="font-medium text-gray-700">Enable auto calculation of VFL Identifier</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
