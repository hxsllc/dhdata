<div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-8 my-4">
    <div class="sm:col-span-1">
        <div>
            <label for="mSubCollection01" class="block text-sm font-medium text-gray-700">Subcollection 1</label>
            <div class="">
                <input type="text"
                       name="mSubCollection01"
                       id="mSubCollection01"
                       placeholder=""
                       value="{{ $record->mSubCollection01 }}"
                       class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
            </div>
        </div>
    </div>
    <div class="sm:col-span-1">
        <div>
            <label for="mSubCollection02" class="block text-sm font-medium text-gray-700">Subcollection 2</label>
            <div class="">
                <input type="text"
                       name="mSubCollection02"
                       id="mSubCollection02"
                       placeholder=""
                       value="{{ $record->mSubCollection02 }}"
                       class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
            </div>
        </div>
    </div>
    <div class="sm:col-span-1">
        <div>
            <label for="mSubCollection03" class="block text-sm font-medium text-gray-700">Subcollection 3</label>
            <div class="">
                <input type="text"
                       name="mSubCollection03"
                       id="mSubCollection03"
                       placeholder=""
                       value="{{ $record->mSubCollection03 }}"
                       class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
            </div>
        </div>
    </div>
    <div class="sm:col-span-3">
        <div>
            <label for="rNotes" class="block text-sm font-medium text-gray-700">Microfilm Notes</label>
            <div class="">
                                                        <textarea name="rNotes"
                                                                  id="rNotes"
                                                                  placeholder=""
                                                                  rows="2"
                                                                  class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">{{ $record->rNotes }}</textarea>
            </div>
        </div>
    </div>
</div>

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
                       @if($record->exists) disabled @endif
                       class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md @if($record->exists) bg-gray-300 @endif">
            </div>
        </div>
    </div>
    <div class="sm:col-span-1">
        <div>
            <label for="rMasterNegNumber" class="block text-sm font-medium text-gray-700">Roll (New)</label>
            <div class="">
                <input type="text"
                       name="rMasterNegNumber"
                       id="rMasterNegNumber"
                       placeholder=""
                       value="{{ $record->roll  }}"
                       class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md @if($record->exists) bg-indigo-100 @endif">
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
                       @if($record->exists) disabled @endif
                       class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md @if($record->exists) bg-gray-300 @endif">
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
                       class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md @if($record->exists) bg-indigo-100 @endif">
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

<div class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-8 my-4">
    <div class="sm:col-span-3">
        <div>
            <label for="mFolderNumber" class="block text-sm font-medium text-gray-700">VFL Identifier</label>
            <div class="">
                <input type="text"
                       name="mFolderNumber"
                       id="mFolderNumber"
                       placeholder="{{ $record->calulated_identifier }}"
                       value="{{ $record->mFolderNumber }}"
                       class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
            </div>
        </div>
    </div>
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
    <div class="sm:col-span-3">
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
</div>

@if($record->exists)
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
@endif
