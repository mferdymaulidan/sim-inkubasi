<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Kelas') }}
        </h2>
    </x-slot>
    <div class="pt-5">
        <div>
            <form id="tambah-kelas" action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="tambah-kelas-div" class="bg-white overflow-hidden shadow-sm mx-auto p-6">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Kelas</h1>
                    <h2 class="mt-3">Masukkan Nama Kelas</h2>
                <input type="text" name="kelas" placeholder="Kelas" class="border border-gray-300 rounded-lg">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 my-3 rounded">Tambah Kelas</button>
                </div>
            </form>
            <form id="ubah-kelas" method="POST" enctype="multipart/form-data" class="hidden">
                @csrf
                @method('PUT')
                <div class="bg-white overflow-hidden shadow-sm mx-auto p-6 hidden" id="ubah-kelas-div">
                    <h1 class="font-semibold text-xl text-gray-800 leading-tight">Ubah Kelas</h1>
                    <h2 class="mt-3">Masukkan Nama Kelas</h2>
                    <input type="hidden" name="id" id="kelas_id">
                    <input type="text" name="kelas" id="kelas_nama" class="border border-gray-300 rounded-lg">
                    <button type="submit" class="bg-blue-500 hover:bg-sky-500 text-white font-bold py-2 px-4 my-3 rounded">Ubah Kelas</button>
                    <button type="button" onclick="tutupForm()" class="bg-red-500 hover:bg-orange-500 text-white font-bold py-2 px-4 my-3 rounded">Batal</button>
                </div>
            </form>
        </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full mt-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full bg-white rounded-lg overflow-hidden">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white w-[10%]">ID</th>
                                <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Nama Kelas</th>
                                <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white w-1/6">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $k)
                                <tr>
                                    <td class="py-2 px-4 border border-gray-200 w-[10%] text-center">{{ $k->id }}</td>
                                    <td class="py-2 px-4 border border-gray-200">{{ $k->kelas }}</td>
                                    <td class="border border-gray-200 w-1/6 text-center">
                                        <button type="button" onclick="editKelas('{{ $k->id }}', '{{ $k->kelas }}')" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 m-1 rounded">Edit</button>
                                        <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" class="inline-block">
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

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: "{{ session('success') }}",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: true,
            });
        </script>
    @elseif (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: true,
            });
        </script>
    @endif

    <script>
        function editKelas(id, kelas) {
            console.log(id, ' ', kelas);
            document.getElementById('ubah-kelas').classList.remove('hidden');
            document.getElementById('ubah-kelas-div').classList.remove('hidden');
            document.getElementById('tambah-kelas').classList.add('hidden');
            document.getElementById('tambah-kelas-div').classList.add('hidden');
            document.getElementById('kelas_id').value = id;
            document.getElementById('kelas_nama').value = kelas;
            document.getElementById('ubah-kelas').action = '/kelas/' + id;
        }

        function tutupForm() {
            document.getElementById('ubah-kelas').classList.add('hidden');
            document.getElementById('tambah-kelas').classList.remove('hidden');
            document.getElementById('tambah-kelas-div').classList.remove('hidden');
            document.getElementById('ubah-kelas-div').classList.add('hidden');
        }
    </script>
</x-app-layout>