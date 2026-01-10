<x-app-layout>
  <div class="container mx-auto p-6">
    <header class="flex items-start justify-between mb-6">
      <div>
        <h1 class="text-2xl font-semibold text-gray-900">Admin Control Panel</h1>
        <p class="text-sm text-gray-500">Overview of platform health and moderation tools.</p>
      </div>

      <nav class="flex items-center space-x-2">
        <a href="#" class="px-3 py-1 rounded-md text-sm text-gray-600 hover:text-gray-900">Stats</a>
        <a href="#" class="px-3 py-1 rounded-md text-sm bg-blue-600 text-white shadow-sm">Users</a>
        <a href="#" class="px-3 py-1 rounded-md text-sm text-gray-600 hover:text-gray-900">Products</a>
        <a href="#" class="px-3 py-1 rounded-md text-sm text-gray-600 hover:text-gray-900">Bookings</a>
      </nav>
    </header>

    <main>
      <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-lg font-medium text-gray-900">Registered Users</h2>

          <div class="flex items-center space-x-3">
            @if(session('status'))
              <div class="mr-4 px-4 py-2 rounded-full bg-green-50 text-green-800 text-sm">{{ session('status') }}</div>
            @endif

            <form method="GET" action="{{ route('admin.users') }}" class="flex items-center space-x-3">
              <div class="relative">
                <input
                  type="search"
                  name="q"
                  value="{{ request('q') }}"
                  placeholder="Search users..."
                  class="w-72 pl-4 pr-10 py-2 border border-gray-200 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-200"
                >
                <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
                </svg>
              </div>

              <button type="submit" class="px-3 py-2 bg-white border border-gray-200 rounded-full text-sm text-gray-700 hover:bg-gray-50">Search</button>
            </form>

            <button id="openUserModal" type="button" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-full shadow-sm hover:bg-blue-700">+ Add User</button>
          </div>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-100">
            <thead>
              <tr class="text-left text-xs font-semibold text-gray-500 uppercase">
                <th class="px-4 py-3">User</th>
                <th class="px-4 py-3">Role</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Joined</th>
                <th class="px-4 py-3">Actions</th>
              </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-100">
              @foreach($users as $user)
                @php
                  $avatar = isset($user->avatar_url) && $user->avatar_url ? asset('storage/' . $user->avatar_url) : asset('images/avatar-placeholder.png');
                  $roleIsAdmin = isset($user->is_admin) ? (bool)$user->is_admin : (isset($user->role) && strtolower($user->role) === 'admin');
                  $statusActive = strtolower($user->status ?? 'active') === 'active';
                @endphp

                <tr class="hover:bg-gray-50">
                  <td class="px-4 py-4">
                    <div class="flex items-center space-x-3">
                      <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-100 flex-shrink-0">
                        <img src="{{ $avatar }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                      </div>
                      <div>
                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                      </div>
                    </div>
                  </td>

                  <td class="px-4 py-4">
                    @if($roleIsAdmin)
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700">ADMIN</span>
                    @else
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-50 text-gray-800">USER</span>
                    @endif
                  </td>

                  <td class="px-4 py-4">
                    <div class="inline-flex items-center space-x-2">
                      @if($statusActive)
                        <span class="w-2 h-2 rounded-full bg-green-400 inline-block"></span>
                        <span class="text-sm text-gray-700">active</span>
                      @else
                        <span class="w-2 h-2 rounded-full bg-gray-300 inline-block"></span>
                        <span class="text-sm text-gray-500">inactive</span>
                      @endif
                    </div>
                  </td>

                  <td class="px-4 py-4 text-sm text-gray-600">
                    {{ optional($user->created_at)->format('M d, Y') ?? '—' }}
                  </td>

                  <td class="px-4 py-4">
                    <div class="flex items-center space-x-2">
                      <a href="{{ route('users.show', $user) }}" title="View" class="p-2 bg-blue-50 text-blue-600 rounded-full text-sm hover:bg-blue-100 inline-flex items-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z"/>
                        </svg>
                      </a>

                      <form method="POST" action="{{ route('admin.users.disable', $user) }}" class="inline">
                        @csrf
                        <button type="submit" title="Disable" class="p-2 bg-yellow-50 text-yellow-600 rounded-full text-sm hover:bg-yellow-100">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-12.728 12.728M5.636 5.636l12.728 12.728"/>
                          </svg>
                        </button>
                      </form>

                      <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Delete this user?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Delete" class="p-2 bg-red-50 text-red-600 rounded-full text-sm hover:bg-red-100">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="mt-4">
            {{ $users->links() }}
          </div>
        </div>

        <!-- Add User Modal -->
        <div id="userModal" class="hidden fixed inset-0 z-50 flex items-center justify-center">
          <div class="absolute inset-0 bg-black opacity-40" id="userModalOverlay"></div>

          <div class="relative bg-white rounded-2xl shadow-lg w-full max-w-xl mx-4 p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-lg font-medium">Add New User</h3>
              <button id="closeUserModal" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>

            <form method="POST" action="{{ route('admin.users.store') }}">
              @csrf
              <div class="grid grid-cols-1 gap-4">
                <div>
                  <label class="block text-xs font-medium text-gray-700">Name</label>
                  <input name="name" type="text" required class="mt-1 w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-200" />
                </div>

                <div>
                  <label class="block text-xs font-medium text-gray-700">Email</label>
                  <input name="email" type="email" required class="mt-1 w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-200" />
                </div>

                <div>
                  <label class="block text-xs font-medium text-gray-700">Password</label>
                  <input name="password" type="password" required class="mt-1 w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-200" />
                </div>

                <div class="flex items-center space-x-3">
                  <label class="inline-flex items-center text-sm">
                    <input type="checkbox" name="is_admin" value="1" class="form-checkbox h-4 w-4 text-indigo-600" />
                    <span class="ml-2 text-gray-700">Make admin</span>
                  </label>
                </div>
              </div>

              <div class="mt-6 flex justify-end space-x-3">
                <button type="button" id="cancelUserModal" class="px-4 py-2 bg-white border border-gray-200 rounded-full text-sm text-gray-700 hover:bg-gray-50">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm hover:bg-blue-700">Create User</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
</x-app-layout>

<script>
  (function(){
    const openBtn = document.getElementById('openUserModal');
    const modal = document.getElementById('userModal');
    const overlay = document.getElementById('userModalOverlay');
    const closeBtn = document.getElementById('closeUserModal');
    const cancelBtn = document.getElementById('cancelUserModal');

    function open() { modal.classList.remove('hidden'); }
    function close() { modal.classList.add('hidden'); }

    if (openBtn) openBtn.addEventListener('click', open);
    if (closeBtn) closeBtn.addEventListener('click', close);
    if (cancelBtn) cancelBtn.addEventListener('click', close);
    if (overlay) overlay.addEventListener('click', close);
  })();
</script>
