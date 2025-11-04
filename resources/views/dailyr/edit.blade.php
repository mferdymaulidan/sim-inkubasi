<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Ubah Laporan Harian') }}
            </h2>
        </x-slot>
    <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full mt-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4 justify-end flex">
                        <a href="/dailyr" class="bg-gray-500 text-white rounded px-3 py-2">Kembali</a>
                    </div>
                    <form action="{{ route('dailyr.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="border border-gray-200 rounded-lg p-6 mb-4">
                            <p><strong>Nama Siswa:</strong> {{ $data->siswas->nama }}</p>
                            <input type="file" id="dokumen" name="dokumen" class="mt-2 w-full" placeholder="Upload Dokumen Baru"/>
                            <textarea name="keterangan" id="keterangan" class="mt-2 w-full" placeholder="Keterangan">{{ old('keterangan', $data->keterangan) }}</textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white rounded px-3 py-2">Simpan Perubahan</button>
                        <button type="reset" class="bg-red-500 text-white rounded px-3 py-2">Batalkan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>