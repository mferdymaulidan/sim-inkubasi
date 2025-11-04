<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Tambah Laporan') }}
        </h2>
    </x-slot>

    <div class="w-full h-full pt-5">
        <div class="w-full p-9 grid grid-cols-1 bg-white rounded-md items-center">
            <form action="{{ route('dailyr.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @role('admin')
                <select class="w-full rounded m-2" name="siswa_id" id="siswa_id">
                    @foreach($data as $da)
                        <option value="{{$da->id}}">{{ $da->nama }}</option>
                    @endforeach
                </select>
                @endrole
                @role('siswa')
                <input class="w-full rounded m-2" type="text" name="siswa_id" value="{{ Auth::user()->siswa->nama }}" readonly>
                <input type="hidden" name="siswa_id" value="{{ Auth::user()->siswa->id }}" hidden>
                @endrole
                <input class="w-full m-2 border border-black p-2 rounded" type="file" name="report" id="report">
                <textarea name="keterangan" id="keterangan" class="w-full p-2 m-2 border border-black rounded" placeholder="Keterangan"></textarea>
                <button type="submit" class="bg-blue-500 text-white rounded px-3 py-2 ml-2">Simpan</button>
                <button type="button" onclick="window.location='{{ route('dailyr.index') }}'" class="bg-gray-500 text-white rounded px-3 py-2">Kembali</button>
            </form>
        </div>
    </div>
</x-app-layout>