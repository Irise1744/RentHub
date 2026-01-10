<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-amber-50 px-4">

        <div class="w-full max-w-2xl bg-white rounded-3xl shadow-2xl relative">
            <div class="h-2 rounded-t-3xl bg-gradient-to-r from-blue-600 to-amber-400"></div>

            <a href="{{ route('users.index') }}" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">✕</a>

            <div class="p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Add New User</h2>
                <p class="text-sm text-gray-500 mb-6">Create an account and assign their role</p>

                @if ($errors->any())
                    <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <div class="font-semibold mb-1">Please fix the following:</div>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">FULL NAME</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500"
                                   required>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">EMAIL ADDRESS</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500"
                                   required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">ROLE</label>
                            <select name="role"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">PHONE (OPTIONAL)</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-1">ADDRESS (OPTIONAL)</label>
                        <textarea name="address" rows="3"
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500">{{ old('address') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">PASSWORD</label>
                            <input type="password" name="password"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500"
                                   required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">CONFIRM PASSWORD</label>
                            <input type="password" name="password_confirmation"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500"
                                   required>
                        </div>
                    </div>

                    <div class="flex justify-between gap-4 pt-2">
                        <a href="{{ route('users.index') }}"
                           class="w-1/2 text-center px-4 py-3 rounded-xl border border-gray-200 text-gray-600 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                                class="w-1/2 px-4 py-3 rounded-xl font-semibold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/30">
                            Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
