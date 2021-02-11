<div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
    <div class="space-y-6 sm:space-y-5">
        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                Name
            </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <input type="text"
                       name="name"
                       id="name"
                       class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
                       value="{{ $user->name }}"
                >
            </div>
        </div>

        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="email" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                Email address
            </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <input id="email"
                       name="email"
                       type="email"
                       class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                       value="{{ $user->email }}"
                >
            </div>
        </div>

        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="password" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                Password
            </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <input id="password"
                       name="password"
                       type="text"
                       class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                       value=""
                >
            </div>
        </div>

        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="role" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                Role
            </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <select id="role"
                        name="role"
                        class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                    <option value="editor" @if($user->role == 'editor') selected @endif>Editor</option>
                    <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                </select>
            </div>
        </div>
    </div>
</div>
