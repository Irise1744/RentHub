<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-amber-50 px-4">
        
        <!-- Card -->
        <div class="w-full max-w-lg bg-white rounded-3xl shadow-2xl relative">

            <!-- Top Accent -->
            <div class="h-2 rounded-t-3xl bg-gradient-to-r from-blue-600 to-amber-400"></div>

            <!-- Close -->
            <a href="{{ route('admin.users') }}"
               class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                ✕
            </a>

            <div class="p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-1">
                    Edit User Details
                </h2>
                <p class="text-sm text-gray-500 mb-6">
                    Update user information and permissions
                </p>

                    <form method="POST"
                        action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-500 mb-1">
                            FULL NAME
                        </label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200
                                   focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-gray-500 mb-1">
                            EMAIL ADDRESS
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200
                                   focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500"
                            required>
                    </div>

                    <!-- Role + Phone -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">
                                ROLE
                            </label>
                            <select
                                name="role"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200
                                       focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500">
                                <option value="user" {{ old('role', $user->is_admin ? 'admin' : 'user') === 'user' ? 'selected' : '' }}>
                                    User
                                </option>
                                <option value="admin" {{ old('role', $user->is_admin ? 'admin' : 'user') === 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>
                            </select>
                        </div>

                        
                    </div>

                    <!-- Address -->
                    <div class="mb-6">
                        <label class="block text-xs font-semibold text-gray-500 mb-1">
                            ADDRESS
                        </label>
                        <textarea
                            name="address"
                            rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200
                                   focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500">{{ old('address', $user->address) }}</textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-between gap-4">
                        <a href="{{ route('users.index') }}"
                           class="w-1/2 text-center px-4 py-3 rounded-xl border border-gray-200
                                  text-gray-600 hover:bg-gray-50">
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="w-1/2 px-4 py-3 rounded-xl font-semibold text-white
                                   bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/30">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
