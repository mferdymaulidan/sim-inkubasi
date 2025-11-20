<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Laptop') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-8">
                    <a href="{{ route('laptop.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4">Tambah Laptop</a>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Laptop List -->
                     <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Model</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksesoris</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($laptops as $laptop)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><img src="{{ asset('storage/' . $laptop->gambar) }}" alt="Laptop" class="max-w-32 h-auto"></td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $laptop->brand }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $laptop->model }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $laptop->aksesoris }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $laptop->siswa->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="mb-2">
                                            <a href="{{ route('laptop.edit', $laptop->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold rounded py-1 px-2">Edit</a>
                                        </div>
                                        <form action="{{ route('laptop.destroy', $laptop->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- End Laptop List -->
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: true
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
            showConfirmButton: true
        });
    </script>
    @endif
</x-app-layout>