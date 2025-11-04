<x-app-layout>

     <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Ubah Data User') }}
        </h2>
    </x-slot>

    <div class="w-full h-full pt-5">
        <div class="w-full p-9 grid grid-cols-1 bg-white rounded-md items-center">
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="text" name="name" placeholder="Nama User" value="{{ old('name', $user->name) }}" class="border border-gray-300 brounded py-2 w-full mb-4"/>
                <input type="email" name="email" placeholder="Email" value="{{ old('email', $user->email) }}" class="border border-gray-300 rounded py-2 w-full mb-4"/>
                <input type="password" name="password" placeholder="Password" class="border border-gray-300 rounded py-2 w-full mb-4"/>
                <input type="password" name="password_confirmation" placeholder="konfirmasi Password" class="border border-gray-300 rounded py-2 w-full mb-4"/>
                <div class="mb-4">
                    <select name="siswa_id" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($siswa as $s)
                            <option {{ optional($user->siswa)->id == $s->id ? 'selected' : '' }} value="{{ $s->id }}">{{ $s->nama }}</option>
                        @endforeach
                            <option value="">Bukan Siswa</option>
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 text-white rounded px-3 py-2 ">Simpan </button>
                <button type="reset" class="bg-red-500 text-white rounded px-3 py-2">Batalkan Perubahan</button>
                <a href="{{ route('user.index') }}" class="bg-gray-500 text-white rounded px-3 py-2">Kembali</a>
            </form>
        </div>
    </div>
</x-app-layout>