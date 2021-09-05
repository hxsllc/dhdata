<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Metadata Editor') }}
        </h2>
    </x-slot>

    <div x-data="{
                tab: 'edit'
            }"
         class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{--<a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 mb-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Add User') }}
                    </a>--}}
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">

                                <div>
                                    <div class="hidden sm:block">
                                        <div class="border-b border-gray-200">
                                            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                                <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                                                <a x-on:click.prevent="tab = 'edit'"
                                                   href="#"
                                                   class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                                                   :class="{ 'border-indigo-500 text-indigo-600': tab === 'edit' }"
                                                >
                                                    {{ __('Item Record') }}
                                                </a>

                                                <a x-on:click.prevent="tab = 'history'"
                                                   href="#"
                                                   class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                                                   :class="{ 'border-indigo-500 text-indigo-600': tab === 'history' }"
                                                >
                                                    {{ __('Version History') }}
                                                </a>

                                            </nav>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="tab == 'edit'">
                                    <div class="pt-5">
                                        <h3 class="text-lg leading-6 font-bold text-gray-900">
                                            {{ $record->mCity }} / {{ $record->mRepository }} / {{ $record->mCollection }}
                                        </h3>
                                    </div>
                                    <div class="my-6">
                                        <form action="{{ route('records.update', ['record' => $record]) }}" method="POST" class="">
                                            @csrf
                                            @method('PUT')

                                            @include('records.form')

                                            <div class="grid grid-cols-4 mt-8">
                                                <div class="grid-cols-1">
                                                    <div class="relative flex items-start">
                                                        <div class="flex items-center h-5">
                                                            <input id="export_manifest"
                                                                   name="export_manifest"
                                                                   type="checkbox"
                                                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                        </div>
                                                        <div class="ml-3 text-sm">
                                                            <label for="export_manifest"
                                                                   class="font-medium text-gray-700">
                                                                Export Manifest
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="grid-cols-1">
                                                    <div class="relative flex items-start">
                                                        <div class="flex items-center h-5">
                                                            <input id="export_to_omeka"
                                                                   name="export_to_omeka"
                                                                   type="checkbox"
                                                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                        </div>
                                                        <div class="ml-3 text-sm">
                                                            <label for="export_to_omeka"
                                                                   class="font-medium text-gray-700">
                                                                Export to Omeka
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sm:col-span-4 mt-8">
                                                <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    {{ __('Update') }}
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                                <div x-show="tab == 'history'">
                                    <div class="flex flex-col my-3">
                                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                    <table class="min-w-full divide-y divide-gray-200">
                                                        <thead class="bg-gray-50">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                                Current Version Edited by: {{ $record->lastUpdatedBy }}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                                Edited on: @if(! empty($record->lastUpdatedOn)) {{ $record->lastUpdatedOn->timezone('America/New_York')->toDateTimeString() }} @endif
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($record->getAttributes() as $key => $attribute)
                                                            <tr class="@if($loop->odd) bg-white @else bg-gray-50 @endif">
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                    {{ $key }}
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                    @if($key == 'lastUpdatedOn' && ! empty($attribute))
                                                                        {{ (new \Carbon\Carbon($attribute))->timezone('America/New_York')->toDateTimeString() }}
                                                                    @else
                                                                        {{ $attribute }}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($record->versions->sortByDesc('created_at') as $version)
                                        <div class="flex flex-col my-3">
                                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                        <table class="min-w-full divide-y divide-gray-200">
                                                            <thead class="bg-gray-50">
                                                                <tr>
                                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                                        Version replaced by: {{ $version->responsible_user->name }}
                                                                    </th>
                                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                                                        Version replaced on: {{ $version->created_at->timezone('America/New_York')->toDateTimeString() }}
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($version->getModel()->getAttributes() as $key => $attribute)
                                                                    <tr class="@if($loop->odd) bg-white @else bg-gray-50 @endif">
                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                            {{ $key }}
                                                                        </td>
                                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                            @if($key == 'lastUpdatedOn')
                                                                                {{ (new \Carbon\Carbon($attribute))->timezone('America/New_York')->toDateTimeString() }}
                                                                            @else
                                                                                {{ $attribute }}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
