<x-app-layout>
    <div class="py-12 flex-wrap gap-4 mt-4">
        <div class="max-w-7xl sm:w-[50%] lg:w-[20%] mx-2 sm:px-6 lg:px-8">
            <a href="/siswa">
                <div class="bg-[#476EAE] text-white hover:text-black hover:bg-blue-500 overflow-hidden shadow-sm sm:rounded-lg p-5 justify-center text-center text-xl">
                    Jumlah Siswa
                    <div class=" text-white hover:text-black  text-xl font-bold">
                        <h1>{{ $jumlahsiswa }} Siswa</h1>
                    </div>
                </div>
            </a>
        </div>
        <div class="max-w-7xl sm:w-[50%] lg:w-[20%] mx-2 sm:px-6 lg:px-8 m-4">
            <a href="/kelas">
                <div class="bg-[#476EAE] text-white hover:text-black hover:bg-blue-500 overflow-hidden shadow-sm sm:rounded-lg p-4 justify-center text-center text-xl">
                    Jumlah Kelas
                    <div class=" text-white hover:text-black  text-xl font-bold">
                        <h1>{{ $jumlahkelas }} Kelas</h1>
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
