<x-app-layout>
<style>
    table th, table td {
        vertical-align: middle;
        border: solid 1px #dcdedfff;
        padding: 10px;
        text-align: center;
    }
</style>

    <div class="card border-0 shadow-sm rounded w-full pt-5">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Siswa ') }}
            </h2>
        </x-slot>
        <div>
            <a href="/siswa/create" class="bg-blue-500 text-white rounded px-3 py-2">Tambah Data</a>
        </div>
        <div class="card-body" style="margin-top:20px;">
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-lg overflow-hidden">
                <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th scope="col" class="bg-blue-500">Nama</th>
                                    <th scope="col" class="bg-blue-500">Tempat Lahir</th>
                                    <th scope="col" class="bg-blue-500">Tanggal Lahir</th>
                                    <th scope="col" class="bg-blue-500">Alamat</th>
                                    <th scope="col" class="bg-blue-500">Kelas</th>
                                    <th scope="col" class="bg-blue-500">NIK</th>
                                    <th scope="col" style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswa as $siswas)
                                    <tr class="even:bg-white odd:bg-blue-50">
                                        <td>{{ $siswas->nama }}</td>
                                        <td>{{ $siswas->tempat_lahir }}</td>
                                        <td>{{ $siswas->tanggal_lahir }}</td>
                                        <td>{{ $siswas->alamat }}</td>
                                        <td>{{ $siswas->Kelas }}</td>
                                        <td>{{ $siswas->nik }}</td>
                                        <td class="text-center">
                                            <form class="flex flex-wrap gap-2 justify-center" onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('siswa.destroy', $siswas->id) }}" method="POST">
                                                <a href="{{ route('siswa.show', $siswas->id) }}" class="inline-block bg-gray-800 text-white rounded px-3 py-2 m-1">Lihat</a>
                                                <a href="{{ route('siswa.edit', $siswas->id) }}" class="inline-block bg-orange-400 text-white rounded px-3 py-2 m-1">Ubah </a>
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded m-1">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Products belum ada.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
            </div>
                        {{ $siswa->links() }}
                    </div>
 @if (session('success'))
    <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
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
            text: '{{ session('error') }}',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: true,
        });
    </script>
@endif
</x-app-layout>