<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new record') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="relative sm:col-span-4">
                                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                        <div class="w-full border-t border-gray-300"></div>
                                    </div>
                                    <div class="relative flex items-center justify-start">
                                        <span class="bg-white px-2 text-gray-500">
                                          <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path fill="#6B7280" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                          </svg>
                                        </span>
                                        <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                                            New record
                                        </span>
                                    </div>
                                </div>
                                <div class="my-6">
                                    <form action="{{ route('records.store') }}" method="POST" class="">
                                        @csrf

                                        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-8 my-4">
                                            <div class="sm:col-span-1">
                                                <div>
                                                    <label for="mCollection" class="sr-only">Collection</label>
                                                    <select id="mCollection"
                                                            name="mCollection"
                                                            class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                                                            required>
                                                        <option value="">-- Select Collection --</option>
                                                        @foreach($collections as $collection)
                                                            @if(! empty($collection->mCollection))
                                                                <option value="{{ $collection->mCollection }}">
                                                                    {{ $collection->mCollection }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        @include('records.form')

                                        {{--<div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-8 my-4">
                                            <div class="sm:col-span-1">
                                                <div>
                                                    <label for="mCity" class="block text-sm font-medium text-gray-700">City</label>
                                                    <div class="">
                                                        <input type="text"
                                                               name="mCity"
                                                               id="mCity"
                                                               placeholder=""
                                                               value=""
                                                               class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-8 my-4">
                                            <div class="sm:col-span-1">
                                                <div>
                                                    <label for="mRepository" class="block text-sm font-medium text-gray-700">Repository</label>
                                                    <div class="">
                                                        <input type="text"
                                                               name="mRepository"
                                                               id="mRepository"
                                                               placeholder=""
                                                               value=""
                                                               class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-8 my-4">
                                            <div class="sm:col-span-1">
                                                <div>
                                                    <label for="rServiceCopyNumber" class="block text-sm font-medium text-gray-700">Service Copy Number</label>
                                                    <div class="">
                                                        <input type="text"
                                                               name="rServiceCopyNumber"
                                                               id="rServiceCopyNumber"
                                                               placeholder=""
                                                               value=""
                                                               class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-8 my-4">
                                            <div class="sm:col-span-1">
                                                <div>
                                                    <label for="mCollection" class="block text-sm font-medium text-gray-700">Collection</label>
                                                    <div class="">
                                                        <input type="text"
                                                               name="mCollection"
                                                               id="mCollection"
                                                               placeholder=""
                                                               value=""
                                                               class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-8 my-4">
                                            <div class="sm:col-span-1">
                                                <div>
                                                    <label for="mCodexNumberOld" class="block text-sm font-medium text-gray-700">Codex (Old)</label>
                                                    <div class="">
                                                        <input type="text"
                                                               name="mCodexNumberOld"
                                                               id="mCodexNumberOld"
                                                               placeholder=""
                                                               value=""
                                                               class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>--}}

                                        <div class="sm:col-span-4 mt-8">
                                            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                {{ __('Create') }}
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
