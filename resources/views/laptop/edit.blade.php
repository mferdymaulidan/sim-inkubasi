<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Tambah Laptop') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('laptop.update', $laptop->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Gambar:</label>
                            <input type="file" name="gambar" id="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="brand" class="block text-gray-700 text-sm font-bold mb-2">Brand:</label>
                            <input type="text" name="brand" id="brand" value="{{ old('brand', $laptop->brand) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="model" class="block text-gray-700 text-sm font-bold mb-2">Model:</label>
                            <input type="text" name="model" id="model" value="{{ old('model', $laptop->model) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="aksesoris" class="block text-gray-700 text-sm font-bold mb-2">Aksesoris Lengkap</label>    
                            <textarea name="aksesoris" id="aksesoris" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('aksesoris', $laptop->aksesoris) }}</textarea>  
                        </div>
                        <div class="mb-4">
                            <label for="siswa_id" class="block text-gray-700 text-sm font-bold mb-2">Siswa:</label>
                            <select name="siswa_id" id="siswa_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                @foreach ($siswa as $s)
                                    <option value="{{ $s->id }}" {{ $laptop->siswa_id == $s->id ? 'selected' : '' }}>{{ $s->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-start">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Laptop</button>
                            <button type="button" onclick="window.location='{{ route('laptop.index') }}'" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 ml-4 rounded focus:outline-none focus:shadow-outline">Kembali</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>