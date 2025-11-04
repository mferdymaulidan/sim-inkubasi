<x-app-layout>
    <div class="mt-4 m-auto p-10 bg-white rounded-lg shadow-md">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Data Siswa: ') }} {{ $siswa->nama }}
            </h2>
        </x-slot>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <table>
                            <tr>
                                <th class="text-left">Nama</th>
                                <td>:</td>
                                <td class="pl-3">{{ $siswa->nama }}</td>
                            </tr>
                            <tr>
                                <th class="text-left">NIK</th>
                                <td>:</td>
                                <td class="pl-3">{{ $siswa->nik }}</td>
                            </tr>
                            <tr>
                                <th class="text-left table-auto">Tempat Lahir</th>
                                <td>:</td>
                                <td class="pl-3">{{ $siswa->tempat_lahir }}</td>
                            </tr>
                            <tr>
                                <th class="text-left">Tanggal Lahir</th>
                                <td>:</td>
                                <td class="pl-3">{{ $siswa->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <th class="text-left align-text-top">Kelas</th>
                                <td>:</td>
                                <td class="pl-3">{{ $siswa->Kelas }}</td>
                            </tr>
                            <tr>
                                <th class="text-left align-text-top">Alamat</th>
                                <td>:</td>
                                <td class="pl-3">{{ $siswa->alamat }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="mt-4 w-full flex justify-end">
                    <a href="{{ route('siswa.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>