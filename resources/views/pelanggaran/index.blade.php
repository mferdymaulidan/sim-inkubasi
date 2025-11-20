<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Pelanggaran') }}
            </h2>
        </x-slot>
    <div class="py-5">
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('pelanggaran.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Pelanggaran</a>
                <div class="overflow-x-auto">
                    <table class="w-full bg-white rounded-lg overflow-hidden">
                        <tr>
                            <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Nomor Surat</th>
                            <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Nama Pelanggar</th>
                            <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Pelanggaran</th>
                            <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Sanksi</th>
                            <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Tanggal Keputusan</th>
                            <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Aksi</th>
                        </tr>
                        @if ($pelanggaran->isEmpty())
                            <tr>
                                <td class="py-2 px-4 border border-gray-200 text-center" colspan="6">Tidak ada data pelanggaran.</td>
                            </tr>
                        @else
                            @foreach ($pelanggaran as $pelanggaran)
                                <tr>
                                    <td class="py-2 px-4 border border-gray-200 text-center">{{ $pelanggaran->nomor_surat }}</td>
                                    <td class="py-2 px-4 border border-gray-200 text-center">{{ $pelanggaran->nama_pelanggar }}</td>
                                    <td class="py-2 px-4 border border-gray-200 text-center">{{ $pelanggaran->pelanggaran }}</td>
                                <td class="py-2 px-4 border border-gray-200 text-center">{{ $pelanggaran->hukuman }}</td>
                                <td class="py-2 px-4 border border-gray-200 text-center">{{ $pelanggaran->tanggal_keputusan }}</td>
                                <td class="border border-gray-200 w-1/6 text-center">
                                    <form class="flex p-3 gap-2 justify-center" onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('pelanggaran.destroy', $pelanggaran->id) }}" method="POST">
                                        <a href="{{ route('surat.pelanggaran', $pelanggaran->id) }}" target="_blank" class="inline-block bg-gray-800 text-white rounded px-3 py-2 m-1">Lihat</a>
                                        <a href="{{ route('pelanggaran.edit', $pelanggaran->id) }}" class="inline-block bg-orange-400 text-white rounded px-3 py-2 m-1">Ubah </a>
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded m-1">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
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