<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Daily Report') }}
            </h2>
        </x-slot>
    <div class="pt-5 mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full">
                <div class="mt-7 ml-7">
                    <a href="/dailyr/create" class="bg-blue-500 text-white rounded px-3 py-2">Tambah Data</a>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                    <table class="w-full bg-white rounded-lg overflow-hidden">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Nama</th>
                                <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Tanggal</th>
                                <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Keterangan</th>
                                <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white w-1/6">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $d)
                                <tr>
                                    <td class="py-2 px-4 border border-gray-200 text-center">{{$d->siswas->nama}}</td>
                                    @if($d->updated_at!=null)
                                    <td class="py-2 px-4 text-center border border-gray-200">{{ $d->updated_at->format('d M Y') }}</td>
                                    @else
                                    <td class="py-2 px-4 text-center border border-gray-200">{{ $d->created_at->format('d M Y') }}</td>
                                    @endif
                                    <td class="py-2 px-4 border border-gray-200">{{ $d->keterangan }}</td>
                                    <td class="border border-gray-200 w-1/6 text-center">
                                        <button type="button" onclick="window.location='{{ route('dailyr.show', $d->id) }}'" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 m-1 rounded">Lihat</button>
                                        @role('admin')
                                        <button type="button" onclick="window.location='{{ route('dailyr.edit', $d->id) }}'" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 m-1 rounded">Edit</button>
                                        <form action="{{ route('dailyr.destroy', $d->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 m-1 rounded" onclick="return confirm('Yakin ingin menghapus kelas ini?')">Hapus</button>
                                        </form>
                                        @endrole
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Laporan belum ada.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>