<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Tambah Laptop') }}
        </h2>
    </x-slot>

     <div class="py-4">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full p-9 grid grid-cols-1 bg-white rounded-md items-center">
                    <form action="{{ route('laptop.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <select class="w-full rounded m-2 px-4" name="siswa_id" id="siswa_id">
                            @foreach($siswa as $da)
                                <option value="{{$da->id}}">{{ $da->nama }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="code" onkeydown="return event.key !== 'Enter'" id="code" class="w-full p-2 m-2 border border-black rounded" placeholder="Code Siswa">
                        <input type="text" name="brand" id="brand" class="w-full p-2 m-2 border border-black rounded" placeholder="Brand Laptop">
                        <input type="text" name="model" id="model" class="w-full p-2 m-2 border border-black rounded" placeholder="Model Laptop">
                        <textarea name="aksesoris" id="aksesoris" class="w-full p-2 m-2 border border-black rounded" placeholder="Aksesoris"></textarea>
                        <h1 class="ml-2">Gambar</h1>
                        <input class="w-full m-2 border border-black p-2 rounded" type="file" name="gambar" id="gambar">
                        <button type="submit" class="bg-blue-500 text-white rounded px-3 py-2 ml-2">Simpan</button>
                        <button type="button" onclick="window.location='{{ route('laptop.index') }}'" class="bg-gray-500 text-white rounded px-3 py-2">Kembali</button>
                    </form>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>