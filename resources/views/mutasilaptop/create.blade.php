<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Tambah Mutasi Laptop') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('mutlaptop.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <select class="w-full rounded m-2 px-4" name="user_id" id="user_id">
                            @foreach($users as $da)
                                <option value="{{$da->id}}">{{ $da->name }}</option>
                            @endforeach
                        </select>
                        <select class="w-full rounded m-2 px-4" name="laptop_id" id="laptop_id">
                            @foreach($laptops as $da)
                                <option value="{{$da->id}}">{{ $da->brand }} {{ $da->model }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-blue-500 text-white rounded px-3 py-2 ml-2">Simpan</button>
                        <button type="button" onclick="window.location='{{ route('mutlaptop.index') }}'" class="bg-gray-500 text-white rounded px-3 py-2">Kembali</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>