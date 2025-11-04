<x-app-layout>

     <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Ubah Data Siswa') }}
        </h2>
    </x-slot>

    <div class="w-full h-full pt-5">
        <div class="w-full p-9 grid grid-cols-1 bg-white rounded-md items-center">
            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="text" name="nama" placeholder="Nama Siswa" value="{{ old('nama', $siswa->nama) }}" class="border border-gray-300 brounded py-2 w-full mb-4"/>
                <input type="text" name="nik" placeholder="NIK" value="{{ old('nik', $siswa->nik) }}" class="border border-gray-300 rounded py-2 w-full mb-4"/>
                <input type="text" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" class="border border-gray-300 rounded py-2 w-full mb-4"/>
                <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" class="border border-gray-300 rounded py-2 w-full mb-4"/>
                <div class="flex flex-wrap w-full mb-4">
                    <input type="text" name="alamat" placeholder="Alamat" value="{{ old('alamat', $siswa->alamat) }}" class="mr-2 border border-gray-300 rounded py-2 w-4/5 mb-4"/>
                    <div class="mb-4 w-[19%]">
                        <!-- <x-dropdown width="100%">
                            <x-slot name="trigger">
                                <input type="hidden" id="kelas_id" name="kelas_id" value="{{ old('kelas_id', $siswa->kelas_id) }}">
                                <button type="button" id="kelas_nama" name="kelas_nama" class="inline-flex w-full items-center px-3 py-3 border border-gray-300 text-sm leading-4 font-medium rounded-md hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ old('kelas_nama', optional($siswa->kelas)->kelas) }}</div>

                                    <div class="ml-auto">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                                <x-slot name="content" width="100%">
                                    @foreach($kelass as $kls)
                                        <x-dropdown-link onclick="document.getElementById('kelas_id').value='{{ $kls->id }}'; document.getElementById('kelas_nama').textContent='{{ $kls->kelas }}'">
                                            {{ $kls->kelas }}
                                        </x-dropdown-link>
                                    @endforeach
                                </x-slot>
                        </x-dropdown> -->
                        <select name="kelas_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach($kelass as $kls)
                                <option {{ optional($kelas)->kelas_id == $kls->id ? 'selected' : '' }} value="{{ $kls->id }}">{{ $kls->kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="bg-blue-500 text-white rounded px-3 py-2 ">Simpan </button>
                <button type="reset" class="bg-red-500 text-white rounded px-3 py-2">Batalkan Perubahan</button>
                <a href="{{ route('siswa.index') }}" class="bg-gray-500 text-white rounded px-3 py-2">Kembali</a>
            </form>
        </div>
    </div>
</x-app-layout>