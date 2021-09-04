<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Export to Omeka') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-visible shadow-sm sm:rounded-lg">


                <div class="p-6 bg-white border-b border-gray-200">




                    <div class="flex flex-col">
                        <div class="-my-2 sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle sm:px-6 lg:px-8">

                                <div class="my-4">
                                    <form action="{{ route('omeka.process') }}" method="POST" class="grid grid-cols-1 gap-y-6 sm:grid-cols-3 lg:grid-cols-4 sm:gap-x-8">
                                        @csrf
                                        <div class="sm:col-span-1">
                                            <button type="submit" class="mt-6 w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                 Export to Omeka
                                            </button>
                                        </div>

                                    </form>
                                </div>

                                @if($errors->count() > 0)
                                    <div class="top-pagination py-2 align-middle inline-block min-w-full sm:px-6 lg:px-2">
                                        @if($errors->total() > 25)
                                            {!! $errors->links() !!}
                                        @else
                                            <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
                                                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                                    <div>
                                                        <p class="text-sm text-gray-700 leading-5">
                                                            Showing
                                                            <span class="font-medium">1</span>
                                                            to
                                                            <span class="font-medium">{{ $errors->count() }}</span>
                                                            of
                                                            <span class="font-medium">{{ $errors->count() }}</span>
                                                            results
                                                        </p>
                                                    </div>
                                                </div>
                                            </nav>
                                        @endif
                                    </div>
                                    @include('export.errors')
                                @endif

                            </div>

                            @if($errors->count() > 0)
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    {!! $errors->links() !!}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
