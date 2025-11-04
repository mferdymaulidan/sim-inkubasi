<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Pelanggaran') }}
        </h2>
    </x-slot>

    <div class="pt-5">
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('pelanggaran.update', $pelanggaran->id) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <label for="kelassiswa_id" class="block text-sm font-medium text-gray-700">Nama Pelanggar</label>
                            <select name="kelassiswa_id" id="kelassiswa_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                                <option value="" disabled>Pilih Siswa</option>
                                @foreach($kelassiswa as $ks)
                                    <option value="{{ $ks->id }}" {{ $pelanggaran->kelassiswa_id == $ks->id ? 'selected' : '' }}>{{ $ks->nama_siswa }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="pelanggaran" class="block text-sm font-medium text-gray-700">Pelanggaran</label>
                            <textarea name="pelanggaran" id="pelanggaran" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>{{ $pelanggaran->pelanggaran }}</textarea>
                        </div>
                        <div class="mt-4">
                            <label for="bukti" class="block text-sm font-medium text-gray-700">Bukti</label>
                            <input type="file" name="bukti" id="bukti" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                            <p class="mt-2 text-sm text-gray-600">Bukti saat ini : </p>
                            <img name="gambar" id="gambar" src="{{ asset('storage/pelanggaran/'.$pelanggaran->bukti) }}" style="width: 300px; height: auto;" frameborder="0"></img>
                        </div>
                        <div class="mt-4">
                            <label for="hukuman" class="block text-sm font-medium text-gray-700">Sanksi</label>
                            <textarea name="hukuman" id="hukuman" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>{{ $pelanggaran->hukuman }}</textarea>
                        </div>
                        <div class="mt-4">
                            <label for="tanggal_keputusan" class="block text-sm font-medium text-gray-700">Tanggal Keputusan</label>
                            <input type="date" name="tanggal_keputusan" id="tanggal_keputusan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" value="{{ $pelanggaran->tanggal_keputusan }}" required>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
                            <a href="{{ route('pelanggaran.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    const fileInput = document.getElementById('bukti');
    const gambar = document.getElementById('gambar');

    fileInput.addEventListener('change', function() {
        const file = fileInput.files[0];
        if(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                gambar.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
</x-app-layout>