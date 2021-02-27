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

                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                        <div class="w-full border-t border-gray-300"></div>
                                    </div>
                                    <div class="relative flex justify-start">
                                        <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                                          Source Data
                                        </span>
                                    </div>
                                </div>
                                <div class="pt-5">
                                    <h3 class="text-lg leading-6 font-bold text-gray-900">
                                        {{ $record->mCollection }}
                                    </h3>
                                </div>
                                <div class="my-6">
                                    <form action="{{ route('records.update', ['record' => $record]) }}" method="POST" class="">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-8">
                                            <div class="sm:col-span-1">
                                                <div>
                                                    <label for="rServiceCopyNumber" class="block text-sm font-medium text-gray-700">Service Copy Number</label>
                                                    <div class="">
                                                        <input type="text"
                                                               name="rServiceCopyNumber"
                                                               id="rServiceCopyNumber"
                                                               placeholder=""
                                                               value="{{ $record->rServiceCopyNumber }}"
                                                               disabled
                                                               class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md bg-gray-300">
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
                                                               placeholder=""
                                                               value="{{ $record->roll  }}"
                                                               class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md bg-indigo-100">
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
                                                               value="{{ $record->mCodexNumberOld }}"
                                                               disabled
                                                               class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md bg-gray-300">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sm:col-span-1">
                                                <div>
                                                    <label for="mCodexNumberNew" class="block text-sm font-medium text-gray-700">Codex (New)</label>
                                                    <div class="">
                                                        <input type="text"
                                                               name="mCodexNumberNew"
                                                               id="mCodexNumberNew"
                                                               placeholder=""
                                                               value="{{ $record->old_codex }}"
                                                               class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md bg-indigo-100">
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
                                                               placeholder="01"
                                                               value="{{ $record->part }}"
                                                               class="py-3 px-4 block w-full shadow-sm placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500  border-gray-300 rounded-md @if($record->qualifier_is_edited == true) bg-indigo-100 @endif">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
                                                    Cataloging Information
                                                </span>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-8 my-4">
                                            <div class="sm:col-span-1">
                                                <div>
                                                    <label for="mCountry" class="block text-sm font-medium text-gray-700">Country</label>
                                                    <div class="">
                                                        <input type="text"
                                                               name="mCountry"
                                                               id="mCountry"
                                                               placeholder=""
                                                               value="{{ $record->mCountry }}"
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
                                                               placeholder=""
                                                               value="{{ $record->mLanguage }}"
                                                               class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sm:col-span-1">
                                                <div>
                                                    <label for="mCentury" class="block text-sm font-medium text-gray-700">Century</label>
                                                    <div class="">
                                                        <input type="text"
                                                               name="mCentury"
                                                               id="mCentury"
                                                               placeholder=""
                                                               value="{{ $record->mCentury }}"
                                                               class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
                                                    Digitization Information
                                                </span>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-8 my-4">
                                            <div class="sm:col-span-1">
                                                <div>
                                                    <label for="mFolderNumber" class="block text-sm font-medium text-gray-700">VFL Identifier</label>
                                                    <div class="">
                                                        <input type="text"
                                                               name="mFolderNumber"
                                                               id="mFolderNumber"
                                                               placeholder=""
                                                               value="{{ $record->mFolderNumber }}"
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
                                                               placeholder=""
                                                               value="{{ $record->mTextReference }}"
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
                                                               value="{{ $record->mDateDigitized }}"
                                                               class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
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
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
