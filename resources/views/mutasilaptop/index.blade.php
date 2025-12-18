<x-app-layout>
<div class="py-4 mt-12">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="lg:grid lg:grid-cols-2 gap-4">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form action="{{ route('mutlaptop.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <h3 class="text-lg font-medium text-gray-900 mb-4">RFID</h3>
                            <input type="text" id="code" name="code" class="border border-gray-300 rounded-md p-2 w-full" oninput="document.getElementById('code').form.submit()" placeholder="Scan RFID here..." autofocus>
                        </form>
                        <h1 class="text xl mt-4 font-bold">5 Riwayat Mutasi</h1>
                        <div class="overflow-x-auto">
                        <table class="w-full mt-2 overflow-hidden">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2 rounded-l bg-blue-500 text-white">Gambar</th>
                                    <th class="border px-4 py-2 bg-blue-500 text-white">Laptop</th>
                                    <th class="border px-4 py-2 bg-blue-500 text-white">Siswa</th>
                                    <th class="border px-4 py-2 bg-blue-500 text-white">Status</th>
                                    <th class="border px-4 py-2 bg-blue-500 text-white">Tanggal Ambil</th>
                                    <th class="border px-4 py-2 rounded-r bg-blue-500 text-white">Tanggal Kembali</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayat as $mut)
                                <tr>
                                    <td class="border px-4 py-2"><img src="{{ asset('storage/' . $mut->laptop->gambar) }}" alt="Laptop" class="max-w-24 h-auto"></td>
                                    <td class="border px-4 py-2 text-center">{{ $mut->laptop->brand }} {{ $mut->laptop->model }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $mut->laptop->siswa->nama }}</td>
                                    <td class="border px-4 py-2 text-center">{{ ucfirst($mut->status) }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $mut->created_at }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $mut->updated_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1 class="text xl mt-4 font-bold">Belum Kembali</h1>
                        <div class="overflow-x-auto">
                        <table class="w-full mt-2 overflow-hidden">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2 rounded-l bg-blue-500 text-white">Gambar</th>
                                    <th class="border px-4 py-2 bg-blue-500 text-white">Laptop</th>
                                    <th class="border px-4 py-2 bg-blue-500 text-white">Siswa</th>
                                    <th class="border px-4 py-2 bg-blue-500 text-white">Status</th>
                                    <th class="border px-4 py-2 rounded-r bg-blue-500 text-white">Tanggal Ambil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mutasi as $mut)
                                <tr>
                                    <td class="border px-4 py-2"><img src="{{ asset('storage/' . $mut->laptop->gambar) }}" alt="Laptop" class="max-w-24 h-auto"></td>
                                    <td class="border px-4 py-2 text-center">{{ $mut->laptop->brand }} {{ $mut->laptop->model }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $mut->laptop->siswa->nama }}</td>
                                    <td class="border px-4 py-2 text-center">{{ ucfirst($mut->status) }}</td>
                                    <td class="border px-4 py-2 text-center">{{ $mut->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('code').focus();
        });
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 1000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
        </script>
    @elseif(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('code').focus();
        });
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                timer: 1000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
        </script>
    @endif
</x-app-layout>