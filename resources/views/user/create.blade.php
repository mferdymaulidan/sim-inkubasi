<x-app-layout>

     <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Tambah Data User') }}
        </h2>
    </x-slot>

    <div class="w-full h-full pt-5">
        <div class="w-full p-9 grid grid-cols-1 bg-white rounded-md items-center">
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" placeholder="Nama User" class="border border-gray-300 brounded py-2 w-full mb-4"/>
                <input type="email" name="email" placeholder="Email" class="border border-gray-300 rounded py-2 w-full mb-4"/>
                <input type="password" name="password" placeholder="Password" class="border border-gray-300 rounded py-2 w-full mb-4"/>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="border border-gray-300 rounded py-2 w-full mb-4"/>
                <select name="siswa_id" id="siswa" class="border border-gray-300 rounded py-2 w-full mb-4">
                    @foreach($siswa as $s)
                        <option value="{{ $s->id }}">{{ $s->nama }}</option>
                    @endforeach
                        <option value=null>Bukan Siswa</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white rounded px-3 py-2 ">Simpan</button>
                <button type="button" onclick="window.location='{{ route('user.index') }}'" class="bg-gray-500 text-white rounded px-3 py-2">Kembali</button>
            </form>
        </div>
    </div>
</x-app-layout>