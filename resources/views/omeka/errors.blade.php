<div class="shadow overflow-visible border-b border-gray-200 sm:rounded-lg">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                {{ __('Manifest') }}
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                {{ __('Error') }}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($errors as $error)
            <tr class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $error->manifest }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $error->message }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
