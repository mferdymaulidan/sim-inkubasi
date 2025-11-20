<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Galeri Harian') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="sm:px-6 lg:px-8 bg-white">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-xl mb-4 font-bold">Belum Upload</h1>
                        <table class="w-full bg-white rounded-lg overflow-hidden">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Nama</th>
                                    <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($siswa as $item)
                            <tr>
                                <td class="py-2 px-4 border border-gray-200 text-center">{{ $item->nama }}</td>
                                <td class="py-2 px-4 border border-gray-200 text-center">
                                    <button onclick="document.getElementById('galeri{{ $item->id }}').click()">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-blue-500">
                                            <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                                            <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <form id="uploadfoto{{ $item->id }}" action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" id="galeri{{ $item->id }}" name="galeri" onchange="document.getElementById('uploadfoto{{ $item->id }}').submit()" class="hidden">
                                        <input type="hidden" id="siswa_id" name="siswa_id" value="{{ $item->id }}">
                                    </form>
                                </td>
                            </tr>
                        @empty  
                            <tr>
                                <td colspan="2">No data available.</td>
                            </tr> 
                        @endforelse
                            </tbody>
                        </table>
                </div>
            </div>
        </div>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: true
                });
            </script>
        @elseif (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: true
                });
            </script>
        @endif

        <div class="sm:px-6 lg:px-8 mt-8 bg-white">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-xl mb-4 font-bold">Sudah Upload</h1>
                        <table class="w-full bg-white rounded-lg overflow-hidden">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Nama</th>
                                    <th class="py-2 px-4 border border-gray-200 bg-blue-500 text-white">Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($siswas as $items)
                            <tr>
                                <td class="py-2 px-4 border border-gray-200 text-center">{{ $items->nama }}</td>
                                <td class="py-2 px-4 border border-gray-200 text-center">
                                    @foreach ($items->galeri_harian as $foto)
                                        <img src="{{ asset('storage/galeri_harian/' . $foto->foto) }}" alt="" class="mx-auto max-w-xs h-auto object-cover rounded mb-2">
                                    @endforeach
                                </td>
                            </tr>
                        @empty  
                            <tr>
                                <td colspan="2">No data available.</td>
                            </tr> 
                        @endforelse
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>