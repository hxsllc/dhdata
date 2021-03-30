<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Item Records') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-visible shadow-sm sm:rounded-lg">
                @if ($errors->any())
                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="rounded-t-md bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <!-- Heroicon name: solid/x-circle -->
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    There were {{ $errors->count() }} error(s) with pushing to the web queue
                                </h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    {{--<a href="{{ route('records.create') }}" class="inline-flex items-center px-4 py-2 mb-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Add Record') }}
                    </a>--}}
                    <div class="flex flex-col">
                        <div class="-my-2 sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle sm:px-6 lg:px-8">

                                <div class="my-4">
                                    <form action="#" method="GET" class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 lg:grid-cols-5 sm:gap-x-8">
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="shelfmark" class="sr-only">Collection</label>
                                                <select id="shelfmark"
                                                        name="shelfmark"
                                                        class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                    <option value="">All Collections</option>
                                                    @foreach($collections as $collection)
                                                        @if(! empty($collection->mCollection))
                                                            <option value="{{ $collection->mCollection }}"
                                                                @if(request('shelfmark') == $collection) selected @endif>
                                                                {{ $collection->mCollection }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="codex" class="sr-only">Codex</label>
                                                <div class="">
                                                    <input type="text"
                                                           name="codex"
                                                           id="codex"
                                                           placeholder="Codex (Old)"
                                                           value="{{ request('codex') }}"
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="roll" class="sr-only">Roll</label>
                                                <div class="">
                                                    <input type="text"
                                                           name="roll"
                                                           id="roll"
                                                           placeholder="Roll"
                                                           value="{{ request('roll') }}"
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="part" class="sr-only">Part</label>
                                                <div class="">
                                                    <input type="text"
                                                           name="part"
                                                           id="part"
                                                           placeholder="Part"
                                                           value="{{ request('part') }}"
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                SEARCH
                                            </button>
                                        </div>

                                    </form>
                                </div>

                                <div class="shadow overflow-visible border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Manuscript') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Roll') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Part(s)') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('METAscripta ID') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Digitized') }}
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">

                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $record)
                                            <tr class="bg-white">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    <p class="font-bold">
                                                        {{ $record->shelfmark }}, {{ $record->codex }}
                                                    </p>
                                                    <p>
                                                        {{ $record->country }}, {{ $record->century }}
                                                    </p>
                                                    <p class="italic">
                                                        {{ $record->reference }}
                                                    </p>
                                                    {{--<p class="italic">
                                                        {{ $record->lastUpdatedBy }}
                                                    </p>--}}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                    {{ $record->int_roll }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                    {{ $record->int_part }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                    {{ $record->metascripta_id }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    {{ ($record->mDateDigitized != '0000-00-00' ? $record->mDateDigitized : '' ) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('records.edit', ['record' => $record]) }}" class="inline-flex items-center mx-2 px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        {{ _('Edit') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                {!! $records->links() !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
