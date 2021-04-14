<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QC Report') }}
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

                    <div class="flex flex-col">
                        <div class="-my-2 sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle sm:px-6 lg:px-8">

                                <div class="shadow overflow-visible border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Manuscript') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Codex (New)') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Roll (New)') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Part (New)') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Cataloged') }}
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
                                                        {{ $record->mCollection }}, {{ $record->mCodexNumberOld }}
                                                    </p>
                                                    <p>
                                                        {{ $record->mCity }}, {{ $record->mRepository }}
                                                    </p>
                                                    <p>
                                                        {{ __('Service Copy #:') }} {{ $record->rServiceCopyNumber }}
                                                    </p>
                                                    <p class="italic">
                                                        {{ $record->lastUpdatedBy }}
                                                    </p>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $record->mCodexNumberNew }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                    {{ $record->rMasterNegNumber }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                    {{ $record->mQualifier }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    @if($record->isCataloged())
                                                        <div>
                                                            <svg class="h-6 w-6 mx-auto text-green-800" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    @if($record->isDigitized())
                                                        <div>
                                                            <svg class="h-6 w-6 mx-auto text-green-800" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                        {{ ($record->mDateDigitized != '0000-00-00' ? $record->mDateDigitized : '' ) }}
                                                    @endif
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

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
