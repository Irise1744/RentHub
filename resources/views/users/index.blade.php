<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50/30 to-amber-50/20 py-8">
        <!-- Clean Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-blue-100/40 to-transparent rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-amber-100/40 to-transparent rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <!-- Modern Header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">User Management</h1>
                        <p class="text-gray-600">Manage and monitor all platform users</p>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Clean Search Bar -->
                        <div class="relative">
                            <div class="relative flex items-center">
                                <svg class="w-5 h-5 absolute left-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <input
                                    type="text"
                                    placeholder="Search users by name or email..."
                                    class="w-72 pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-600 text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all duration-200">
                            </div>
                        </div>

                        <!-- Modern Add Button -->
                        <a href="{{ route('users.create') }}" class="flex items-center px-5 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 active:scale-95 transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add New User
                        </a>
                    </div>
                </div>
            </div>

            <!-- Clean Divider -->
            <div class="h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent mb-8"></div>

            <!-- Modern List Header -->
            <div class="mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">All Users</h2>
                        <div class="flex items-center space-x-2 mt-1">
                            <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                            <span class="text-sm text-gray-600">{{ count($users) }} active members</span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <button class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                            Filter
                        </button>
                        <button class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                            Sort
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modern User List -->
            <div class="space-y-3 mb-10">
                @forelse($users as $user)
                <!-- Modern List Item -->
                <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <!-- User Info -->
                            <div class="flex-1">
                                <div class="flex items-start space-x-4">
                                    <!-- Clean Avatar -->
                                    <div class="relative">
                                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold text-lg">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-500 rounded-full border-2 border-white flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- User Details -->
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3 mb-2">
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                                            <!-- Role Badge beside name -->
                                            @if($user->is_admin)
                                            <span class="px-2.5 py-1 text-xs font-semibold bg-amber-100 text-amber-800 rounded-lg">
                                                ADMIN
                                            </span>
                                            @else
                                            <span class="px-2.5 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-lg">
                                                USER
                                            </span>
                                            @endif
                                            <div class="flex items-center space-x-2">
                                                <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                                                <span class="text-xs font-medium text-emerald-700">Active</span>
                                            </div>
                                        </div>

                                        <!-- Contact Info side by side -->
                                        <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                {{ $user->email }}
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                                {{ $user->phone ?? '+1 234 567 890' }}
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                Joined {{ $user->created_at?->format('M d, Y') ?? 'Jan 15, 2024' }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center space-x-3 ml-6">
                                <div class="px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg text-sm font-semibold">
                                    <span class="text-base font-bold">{{ rand(3, 20) }}</span>
                                    <span class="ml-1 text-xs font-medium">Rentals</span>
                                </div>

                                <!-- Edit Button -->

                                <a
                                    href="{{ route('admin.users.edit', $user->id) }}"
                                    class="p-2.5 rounded-lg text-gray-400 hover:text-amber-600 hover:bg-amber-50 transition-colors"
                                    title="Edit User">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>


                                <!-- Delete Button inline -->
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2.5 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors" title="Delete User">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Clean Empty State -->
                <div class="text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-blue-100 to-amber-100 rounded-2xl flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">No Users Found</h3>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">
                        Start building your team by inviting the first member to join your platform.
                    </p>
                    <a href="{{ route('users.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add First User
                    </a>
                </div>
                @endforelse
            </div>

            <!-- Clean Footer -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-6 border-t border-gray-200">
                <div class="text-sm text-gray-600">
                    Showing <span class="font-medium text-gray-900">{{ count($users) }}</span> of <span class="font-medium text-gray-900">{{ count($users) }}</span> users
                </div>
                <div class="flex items-center space-x-2">
                    <button class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                        Previous
                    </button>
                    <div class="flex items-center space-x-1">
                        <span class="px-4 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-xl">
                            1
                        </span>
                    </div>
                    <button class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Edit User Modal -->
<div id="editUserModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <div class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-6 pt-6 pb-6 sm:p-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Edit User Details</h3>
                        <p class="text-sm text-gray-500 mt-1">Update user information and permissions</p>
                    </div>
                    <button type="button" onclick="closeEditModal()" class="p-2 rounded-lg hover:bg-gray-100 transition-colors" aria-label="Close edit user modal">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="editUserForm" method="POST" action="">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="editUserName"
                                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-900 text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all duration-200"
                                placeholder="Enter full name"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                                <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="email"
                                name="email"
                                id="editUserEmail"
                                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-900 text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all duration-200"
                                placeholder="user@example.com"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Role
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="relative flex cursor-pointer">
                                    <input
                                        type="radio"
                                        name="role"
                                        value="user"
                                        id="roleUser"
                                        class="sr-only">
                                    <div class="flex-1 py-3 px-4 text-center border border-gray-200 rounded-xl transition-all duration-200">
                                        <span class="text-sm font-medium text-gray-700">User</span>
                                    </div>
                                    <div class="absolute inset-0 border-2 border-blue-500 rounded-xl pointer-events-none opacity-0 transition-opacity duration-200"></div>
                                </label>
                                <label class="relative flex cursor-pointer">
                                    <input
                                        type="radio"
                                        name="role"
                                        value="admin"
                                        id="roleAdmin"
                                        class="sr-only">
                                    <div class="flex-1 py-3 px-4 text-center border border-gray-200 rounded-xl transition-all duration-200">
                                        <span class="text-sm font-medium text-gray-700">Admin</span>
                                    </div>
                                    <div class="absolute inset-0 border-2 border-blue-500 rounded-xl pointer-events-none opacity-0 transition-opacity duration-200"></div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number
                            </label>
                            <input
                                type="tel"
                                name="phone"
                                id="editUserPhone"
                                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-900 text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all duration-200"
                                placeholder="+1 234 567 8900">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Address
                            </label>
                            <textarea
                                name="address"
                                id="editUserAddress"
                                rows="3"
                                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-gray-900 text-sm focus:ring-2 focus:ring-blue-500/30 focus:border-blue-500 transition-all duration-200 resize-none"
                                placeholder="Enter complete address"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="user_id" id="editUserId">
                </form>
            </div>

            <div class="bg-gray-50 px-6 py-5 sm:px-8 flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-4">
                <button
                    type="button"
                    onclick="closeEditModal()"
                    class="mt-3 sm:mt-0 w-full sm:w-auto px-6 py-3 border border-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-all duration-200">
                    Cancel
                </button>
                <button
                    type="button"
                    onclick="submitEditForm()"
                    class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 active:scale-95 transition-all duration-200 shadow-sm hover:shadow-md">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Modal functions
    function openEditModal(userData) {
        // Fill form with user data
        document.getElementById('editUserId').value = userData.id;
        document.getElementById('editUserName').value = userData.name || '';
        document.getElementById('editUserEmail').value = userData.email || '';
        document.getElementById('editUserPhone').value = userData.phone || '';
        document.getElementById('editUserAddress').value = userData.address || '';

        // Set role
        const isAdmin = userData.is_admin === '1' || userData.is_admin === true || userData.role === 'admin';
        if (isAdmin) {
            document.getElementById('roleAdmin').checked = true;
            applyRoleStyles('roleAdmin');
        } else {
            document.getElementById('roleUser').checked = true;
            applyRoleStyles('roleUser');
        }

        // Set form action - IMPORTANT: Use the correct admin route
        document.getElementById('editUserForm').action = `/admin/users/${userData.id}`;

        // Show modal
        document.getElementById('editUserModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeEditModal() {
        document.getElementById('editUserModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        clearRoleStyles();
    }

    function submitEditForm() {
        // Validate form before submission
        const name = document.getElementById('editUserName').value.trim();
        const email = document.getElementById('editUserEmail').value.trim();

        if (!name || !email) {
            alert('Please fill in all required fields.');
            return;
        }

        if (!document.getElementById('roleUser').checked && !document.getElementById('roleAdmin').checked) {
            alert('Please select a role.');
            return;
        }

        document.getElementById('editUserForm').submit();
    }

    // Role selection styling
    function clearRoleStyles() {
        document.querySelectorAll('input[name="role"]').forEach(radio => {
            const parentDiv = radio.parentElement.querySelector('div:first-child');
            const borderDiv = radio.parentElement.querySelector('.absolute');
            parentDiv.classList.remove('border-blue-500', 'bg-blue-50');
            borderDiv.classList.remove('opacity-100');
        });
    }

    function applyRoleStyles(selectedId) {
        clearRoleStyles();
        const radio = document.getElementById(selectedId);
        if (radio) {
            const parentDiv = radio.parentElement.querySelector('div:first-child');
            const borderDiv = radio.parentElement.querySelector('.absolute');
            parentDiv.classList.add('border-blue-500', 'bg-blue-50');
            borderDiv.classList.add('opacity-100');
        }
    }

    // Event listeners for edit buttons
    document.addEventListener('DOMContentLoaded', function() {
        // Add click event to all edit buttons
        document.querySelectorAll('.edit-user-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userData = {
                    id: this.getAttribute('data-user-id'),
                    name: this.getAttribute('data-user-name'),
                    email: this.getAttribute('data-user-email'),
                    phone: this.getAttribute('data-user-phone'),
                    address: this.getAttribute('data-user-address'),
                    is_admin: this.getAttribute('data-user-is-admin')
                };
                openEditModal(userData);
            });
        });

        // Role radio button change events
        document.querySelectorAll('input[name="role"]').forEach(radio => {
            radio.addEventListener('change', function() {
                applyRoleStyles(this.id);
            });
        });

        // Close modal on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !document.getElementById('editUserModal').classList.contains('hidden')) {
                closeEditModal();
            }
        });

        // Close modal when clicking outside
        document.getElementById('editUserModal').addEventListener('click', (e) => {
            if (e.target.id === 'editUserModal') {
                closeEditModal();
            }
        });
    });
</script>

<style>
    #editUserModal {
        transition: opacity 0.3s ease-in-out;
    }

    #editUserModal>div:first-child {
        transition: all 0.3s ease-in-out;
    }

    .overflow-hidden {
        overflow: hidden;
    }
</style>