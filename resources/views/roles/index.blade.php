<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Roles') }}
            </h2>
        </x-slot>
    <div class="pt-5">
        <div>
            <form id="tambah-role" action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="tambah-role-div" class="bg-white overflow-hidden shadow-sm mx-auto p-6">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Role</h1>
                <select name="user_id" id="user_id" class="border border-gray-300 rounded-lg">
                    <option value="" disabled selected>Pilih User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <select name="role_id" id="role_id" class="border border-gray-300 rounded-lg">
                    <option value="" disabled selected>Pilih Role</option>
                    @foreach ($role as $roleb)
                        <option value="{{ $roleb->id }}">{{ $roleb->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Tambah Role</button>
                </div>
            </form>
            <form id="ubah-role" method="POST" enctype="multipart/form-data" class="hidden">
                @csrf
                @method('PATCH')
                <div class="bg-white overflow-hidden shadow-sm mx-auto p-6 hidden" id="ubah-role-div">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Ubah Role</h1>
                    <h2 class="mt-3">Masukkan Role</h2>
                    <select name="role_id" id="role_id" class="border border-gray-300 rounded-lg">
                    <option value="" disabled selected>Pilih Role</option>
                    @foreach ($role as $roleb)
                        <option value="{{ $roleb->id }}">{{ $roleb->name }}</option>
                    @endforeach
                </select>
                    <button type="submit" class="bg-blue-500 hover:bg-sky-500 text-white font-bold py-2 px-4 my-3 rounded">Ubah Role</button>
                    <button type="button" onclick="tutupForm()" class="bg-red-500 hover:bg-orange-500 text-white font-bold py-2 px-4 my-3 rounded">Batal</button>
                </div>
            </form>
        </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full mt-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                    <table class="w-full bg-white rounded-lg overflow-hidden">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Nama</th>
                                <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Role</th>
                                <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white w-1/6">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="py-2 px-4 border border-gray-200 text-center">{{ $user->name }}</td>
                                    <td class="py-2 px-4 text-center border border-gray-200">{{ $roles[$loop->index] }}</td>
                                    <td class="border border-gray-200 w-1/6 text-center">
                                        <button type="button" onclick="editRole('{{ $user->id }}', '{{ $roles[$loop->index] }}')" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 m-1 rounded">Edit</button>
                                        <form action="{{ route('roles.destroy', $user->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 m-1 rounded" onclick="return confirm('Yakin ingin menghapus kelas ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '{{ session('success') }}',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: true,
            });
        </script>
        @elseif(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: true,
            });
        </script>
    @endif 

    <script>
        function editRole(id, role) {
            document.getElementById('ubah-role').classList.remove('hidden');
            document.getElementById('ubah-role-div').classList.remove('hidden');
            document.getElementById('tambah-role').classList.add('hidden');
            document.getElementById('tambah-role-div').classList.add('hidden');
            document.getElementById('role_id').value = id;
            document.getElementById('ubah-role').action = '/roles/' + id;
        }

        function tutupForm() {
            document.getElementById('ubah-role').classList.add('hidden');
            document.getElementById('tambah-role').classList.remove('hidden');
            document.getElementById('tambah-role-div').classList.remove('hidden');
            document.getElementById('ubah-role-div').classList.add('hidden');
        }
    </script>
</x-app-layout>