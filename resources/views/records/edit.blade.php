<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Metadata Editor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{--<a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 mb-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Add User') }}
                    </a>--}}
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="my-6">
                                    <form action="{{ route('records.update', ['record' => $record]) }}" method="POST" class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 lg:grid-cols-4 sm:gap-x-8">
                                        @csrf
                                        @method('PUT')
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="mCity" class="block text-sm font-medium text-gray-700">City</label>
                                                <div class="">
                                                    <input type="text"
                                                           name="mCity"
                                                           id="mCity"
                                                           placeholder="City"
                                                           value="{{ $record->mCity }}"
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="mRepository" class="block text-sm font-medium text-gray-700">Repository</label>
                                                <div class="">
                                                    <input type="text"
                                                           name="mRepository"
                                                           id="mRepository"
                                                           placeholder="Repository"
                                                           value="{{ $record->mRepository }}"
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="rServiceCopyNumber" class="block text-sm font-medium text-gray-700">Service Copy Number</label>
                                                <div class="">
                                                    <input type="text"
                                                           name="rServiceCopyNumber"
                                                           id="rServiceCopyNumber"
                                                           placeholder="rServiceCopyNumber"
                                                           value="{{ $record->rServiceCopyNumber }}"
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="mCollection" class="block text-sm font-medium text-gray-700">Collection</label>
                                                <div class="">
                                                    <input type="text"
                                                           name="mCollection"
                                                           id="mCollection"
                                                           placeholder="Collection"
                                                           value="{{ $record->mCollection }}"
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="mCodexNumberOld" class="block text-sm font-medium text-gray-700">Codex (Old)</label>
                                                <div class="">
                                                    <input type="text"
                                                           name="mCodexNumberOld"
                                                           id="mCodexNumberOld"
                                                           placeholder="Codex (Old)"
                                                           value="{{ $record->mCodexNumberOld }}"
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="rMasterNegNumber" class="block text-sm font-medium text-gray-700">Roll</label>
                                                <div class="">
                                                    <input type="text"
                                                           name="rMasterNegNumber"
                                                           id="rMasterNegNumber"
                                                           placeholder="Roll"
                                                           value="{{ $record->roll  }}"
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="mCodexNumberNew" class="block text-sm font-medium text-gray-700">Codex</label>
                                                <div class="">
                                                    <input type="text"
                                                           name="mCodexNumberNew"
                                                           id="mCodexNumberNew"
                                                           placeholder="Codex"
                                                           value="{{ $record->old_codex }}"
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="mQualifier" class="block text-sm font-medium text-gray-700">Part</label>
                                                <div class="">
                                                    <input type="text"
                                                           name="mQualifier"
                                                           id="mQualifier"
                                                           placeholder="Part"
                                                           value="{{ $record->part }}"
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="relative sm:col-span-4">
                                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                                <div class="w-full border-t border-gray-300"></div>
                                            </div>
                                            <div class="relative flex justify-center">
                                                <span class="bg-white px-2 text-gray-500">
                                                  <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path fill="#6B7280" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                                  </svg>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="mCountry" class="block text-sm font-medium text-gray-700">Country</label>
                                                <div class="">
                                                    <input type="text"
                                                           name="mCountry"
                                                           id="mCountry"
                                                           placeholder="Country"
                                                           value=""
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="mLanguage" class="block text-sm font-medium text-gray-700">Language</label>
                                                <div class="">
                                                    <input type="text"
                                                           name="mLanguage"
                                                           id="mLanguage"
                                                           placeholder="Language"
                                                           value=""
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="mTextReference" class="block text-sm font-medium text-gray-700">Bilbiographic Reference</label>
                                                <div class="">
                                                    <input type="text"
                                                           name="mTextReference"
                                                           id="mTextReference"
                                                           placeholder="Bilbiographic Reference"
                                                           value=""
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="mDateDigitized" class="block text-sm font-medium text-gray-700">Date Digitized</label>
                                                <div class="">
                                                    <input type="date"
                                                           name="mDateDigitized"
                                                           id="mDateDigitized"
                                                           placeholder="Date Digitized"
                                                           value=""
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sm:col-span-1">
                                            <div>
                                                <label for="mFolderNumber" class="block text-sm font-medium text-gray-700">VFL Identifier</label>
                                                <div class="">
                                                    <input type="text"
                                                           name="mFolderNumber"
                                                           id="mFolderNumber"
                                                           placeholder="VFL Identifier"
                                                           value=""
                                                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                        </div>




                                        <div class="sm:col-span-4">
                                            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Update
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
