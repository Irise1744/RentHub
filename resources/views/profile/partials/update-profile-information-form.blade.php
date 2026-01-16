<div class="flex justify-center flex-col items-center px-4">
    <!-- Profile Information -->
    <div class="w-full max-w-4xl bg-white rounded-xl border border-gray-200 shadow-sm p-6 mb-8">
        <div class="flex items-start justify-between mb-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Profile Information</h2>
                <p class="text-sm text-gray-600 mt-2">Update your account's profile information and email address.</p>
            </div>

            <!-- Profile Photo Preview -->
            <div class="flex flex-col items-center">
                <div class="relative">
                    @if($user->avatar)
                    <img id="avatar-preview" 
                         src="{{ \Illuminate\Support\Facades\Storage::url($user->avatar) }}"
                         alt="{{ $user->name }}"
                         class="w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover">
                    @else
                    <div id="avatar-placeholder" 
                         class="w-24 h-24 rounded-full bg-gradient-to-r from-orange-100 to-blue-100 border-4 border-white shadow-lg flex items-center justify-center text-3xl font-bold text-gray-600">
                        {{ substr($user->name ?? 'U', 0, 1) }}
                    </div>
                    @endif
                    <div id="camera-icon" 
                         class="absolute -bottom-2 -right-2 w-10 h-10 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center shadow-lg cursor-pointer hover:from-orange-600 hover:to-orange-700 transition-all">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <span class="text-sm font-medium text-gray-700">{{ $user->name }}</span>
                    <span class="block text-xs text-gray-500">{{ $user->email }}</span>
                </div>
            </div>
        </div>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('patch')

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input id="name"
                                name="name"
                                type="text"
                                value="{{ old('name', $user->name) }}"
                                required
                                autofocus
                                autocomplete="name"
                                class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>
                        @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input id="email"
                                name="email"
                                type="email"
                                value="{{ old('email', $user->email) }}"
                                required
                                autocomplete="username"
                                class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>
                        @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Email Verification -->
                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex items-start">
                                <svg class="h-5 w-5 text-yellow-400 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-yellow-800 font-medium">Your email address is unverified.</p>
                                    <p class="text-sm text-yellow-700 mt-1">
                                        <button form="send-verification"
                                            class="underline hover:text-yellow-900 transition-colors">
                                            Click here to re-send the verification email.
                                        </button>
                                    </p>
                                </div>
                            </div>

                            @if (session('status') === 'verification-link-sent')
                            <p class="mt-3 text-sm text-green-700 font-medium">
                                <svg class="inline h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                A new verification link has been sent to your email address.
                            </p>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Save Button -->
            <div class="pt-6 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-medium rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all shadow-sm hover:shadow">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Save Changes
                    </button>

                    @if (session('status') === 'profile-updated')
                    <div class="flex items-center text-sm text-green-600 animate-fade-in">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Changes saved successfully!
                    </div>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Update Password -->
    <div class="w-full max-w-4xl bg-white rounded-xl border border-gray-200 shadow-sm p-6 mb-8">
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900">Update Password</h2>
            <p class="text-sm text-gray-600 mt-2">Ensure your account is using a long, random password to stay secure.</p>
        </div>

        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <!-- Current Password -->
            <div>
                <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-2">
                    Current Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input id="update_password_current_password"
                        name="current_password"
                        type="password"
                        autocomplete="current-password"
                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>
                @error('current_password', 'updatePassword')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- New Password -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-2">
                        New Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                        </div>
                        <input id="update_password_password"
                            name="password"
                            type="password"
                            autocomplete="new-password"
                            class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    @error('password', 'updatePassword')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 01118 0z" />
                            </svg>
                        </div>
                        <input id="update_password_password_confirmation"
                            name="password_confirmation"
                            type="password"
                            autocomplete="new-password"
                            class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    @error('password_confirmation', 'updatePassword')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Password Requirements -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h3 class="text-sm font-medium text-blue-800 mb-2">Password Requirements</h3>
                <ul class="text-xs text-blue-700 space-y-1">
                    <li class="flex items-center">
                        <svg class="h-3 w-3 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        At least 8 characters long
                    </li>
                    <li class="flex items-center">
                        <svg class="h-3 w-3 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Include uppercase and lowercase letters
                    </li>
                    <li class="flex items-center">
                        <svg class="h-3 w-3 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Include at least one number
                    </li>
                </ul>
            </div>

            <!-- Save Button -->
            <div class="pt-6 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all shadow-sm hover:shadow">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Update Password
                    </button>

                    @if (session('status') === 'password-updated')
                    <div class="flex items-center text-sm text-green-600 animate-fade-in">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Password updated successfully!
                    </div>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Delete Account -->
    <div class="w-full max-w-4xl bg-white rounded-xl border border-gray-200 shadow-sm p-6">
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 text-red-600">Delete Account</h2>
            <p class="text-sm text-gray-600 mt-2">
                Once your account is deleted, all of its resources and data will be permanently deleted.
                Before deleting your account, please download any data or information that you wish to retain.
            </p>
        </div>

        <button x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg hover:from-red-600 hover:to-red-700 transition-all shadow-sm hover:shadow">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            Delete Account
        </button>

        <!-- Modal -->
        <div x-data="{ open: false }"
            x-on:open-modal.window="open = $event.detail === 'confirm-user-deletion'"
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-50 overflow-y-auto"
            style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center">
                <!-- Overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <!-- Modal Panel -->
                <div class="relative bg-white rounded-xl shadow-2xl max-w-md w-full p-6 text-left">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Delete Account</h3>

                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <p class="text-sm text-gray-600 mb-6">
                            Once your account is deleted, all of its resources and data will be permanently deleted.
                            Please enter your password to confirm you would like to permanently delete your account.
                        </p>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input id="password"
                                    name="password"
                                    type="password"
                                    placeholder="Enter your password"
                                    class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                            </div>
                            @error('password', 'userDeletion')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-8 flex justify-end space-x-3">
                            <button type="button"
                                x-on:click="open = false"
                                class="px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                                Cancel
                            </button>

                            <button type="submit"
                                class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg hover:from-red-600 hover:to-red-700 transition-all">
                                Delete Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the elements
    const cameraIcon = document.getElementById('camera-icon');
    const fileInput = document.getElementById('avatar');
    const avatarPreview = document.getElementById('avatar-preview');
    const avatarPlaceholder = document.getElementById('avatar-placeholder');
    
    // If camera icon exists, add click event
    if (cameraIcon) {
        cameraIcon.addEventListener('click', function() {
            fileInput.click();
        });
    }
    
    // When file is selected
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // If avatar preview exists, update its src
                    if (avatarPreview) {
                        avatarPreview.src = e.target.result;
                    } else {
                        // If there's no avatar preview (placeholder was showing),
                        // we need to create one
                        if (avatarPlaceholder) {
                            // Hide the placeholder
                            avatarPlaceholder.style.display = 'none';
                            
                            // Create a new image element
                            const newImg = document.createElement('img');
                            newImg.id = 'avatar-preview';
                            newImg.src = e.target.result;
                            newImg.alt = 'Profile preview';
                            newImg.className = 'w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover';
                            
                            // Insert it before the camera icon's parent
                            const cameraIconParent = cameraIcon.parentElement;
                            cameraIconParent.insertBefore(newImg, cameraIcon);
                        }
                    }
                }
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
});
</script>