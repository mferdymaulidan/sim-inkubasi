<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Detail Laporan Harian') }}
        </h2>
    </x-slot>
    <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full mt-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4 justify-end items-center flex">
                        <a href="/dailyr" class="bg-gray-500 text-white rounded px-3 py-2">Kembali</a>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-6">
                        <p><strong>Nama Siswa:</strong> {{ $data->siswas->nama }}</p>
                        @if($data->updated_at!=null)
                            <p><strong>Tanggal:</strong> {{ $data->updated_at->format('d M Y') }}</p>
                        @else
                            <p><strong>Tanggal:</strong> {{ $data->created_at->format('d M Y') }}</p>
                        @endif
                        <p><strong>Keterangan:</strong> {{ $data->keterangan }}</p>
                        <p><strong>Dokumen Laporan:</strong></p>
                        <iframe src="{{ route('dailyreport.file', $data->dokumen) }}" width="100%" height="600px"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>