<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidiven shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="max-w-4xl mx-auto">
                        <div class="rounded-lg bg-white shadow-lg sm:grid sm:grid-cols-4">
                            <a href="{{ route('records.index') }}"
                               class="hover:bg-gray-200"
                            >
                                <div class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                                    <div class="py-4">
                                        SLU DATA<br />(SQL)
                                    </div>
                                    <div class="border-t border-b border-gray-400 py-2">
                                        <div class="order-1 text-5xl font-extrabold text-gray-600">
                                            {{ number_format( $record_count, 0, '.', ',' ) }}
                                        </div>
                                        <div class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 ">
                                            library records
                                        </div>
                                    </div>
                                    <div class="py-4">
                                        <p>Search</p>
                                        <p>Create</p>
                                        <p>Update</p>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('queue.index') }}"
                               class="hover:bg-gray-200"
                            >
                                <div class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                                    <div class="py-4">
                                        WEB QUEUE<br />(PRE-PUBLICATION)
                                    </div>
                                    <div class="border-t border-b border-gray-400 py-2">
                                        <div class="order-1 text-5xl font-extrabold text-gray-600">
                                            {{--{{ number_format( $record_count, 0, '.', ',' ) }}--}}
                                            --
                                        </div>
                                        <div class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 ">
                                            records in "queue"
                                        </div>
                                    </div>
                                    <div class="py-4">
                                        <p>Metadata</p>
                                        <p>JP2 conversion</p>
                                        <p>IIIF & Mirador</p>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('records.index') }}"
                               class="hover:bg-gray-200"
                            >
                                <div class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                                    <div class="py-4">
                                        WEB CATALOG<br />(OMEKA)
                                    </div>
                                    <div class="border-t border-b border-gray-400 py-2">
                                        <div class="order-1 text-5xl font-extrabold text-gray-600">
                                            {{--{{ number_format( $record_count, 0, '.', ',' ) }}--}}
                                            --
                                        </div>
                                        <div class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 ">
                                            records published
                                        </div>
                                    </div>
                                    <div class="py-4">
                                        <p>Omeka item</p>
                                        <p>IIIF manifest</p>
                                    </div>
                                </div>
                            </a>
                            <a href="http://metascripta.org/manager/db"
                               class="hover:bg-gray-200"
                               target="_blank"
                            >
                                <div class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                                    <div class="py-4">
                                        DBNINJA<br />(OMEKA)
                                    </div>
                                    <div class="border-t border-b border-gray-400 py-2">
                                        <div class="order-1 text-5xl font-extrabold text-gray-600">
                                            AWS
                                        </div>
                                        <div class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500 ">
                                            MySQL database
                                        </div>
                                    </div>
                                    <div class="py-4">
                                        <p>metascripta1</p>
                                        <p>metascripta_dev</p>
                                        <p>slu_sql</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
