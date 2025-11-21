<x-app-layout>

     <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Tambah Data Siswa') }}
        </h2>
    </x-slot>

    <div class="w-full h-full pt-5">
        <div class="w-full p-9 grid grid-cols-1 bg-white rounded-md items-center">
            <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="nama" placeholder="Nama Siswa" class="border border-gray-300 brounded py-2 w-full mb-4"/> <input type="text" onkeydown="return event.key !== 'Enter'" name="code" id="code" placeholder="code" class="border border-gray-300 rounded py-2 w-full mb-4"/>
                <input type="text" name="nik" placeholder="NIK" class="border border-gray-300 rounded py-2 w-full mb-4"/>
                <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" class="border border-gray-300 rounded py-2 w-full mb-4"/>
                <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" class="border border-gray-300 rounded py-2 w-full mb-4"/>
                <input type="text" name="alamat" placeholder="Alamat" class="border border-gray-300 rounded py-2 w-full mb-4"/>
                <button type="submit" class="bg-blue-500 text-white rounded px-3 py-2 ">Simpan</button>
                <button type="button" onclick="window.location='{{ route('siswa.index') }}'" class="bg-gray-500 text-white rounded px-3 py-2">Kembali</button>
            </form>
        </div>
    </div>
</x-app-layout>