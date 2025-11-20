<x-app-layout>
<style>
    table th, table td {
        vertical-align: middle;
        border: solid 1px #dcdedfff;
        padding: 10px;
        text-align: center;
    }
</style>

    <x-slot name="header">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('User ') }}
            </h2>
        </x-slot>
    <div class="card border-0 shadow-sm rounded w-full">
        <div class="mt-7">
            <a href="/user/create" class="bg-blue-500 text-white rounded px-3 py-2">Tambah Data</a>
        </div>
        <div class="card-body" style="margin-top:20px;">
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-lg overflow-hidden">
                <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th scope="col" class="bg-blue-500">ID</th>
                                    <th scope="col" class="bg-blue-500">Nama</th>
                                    <th scope="col" class="bg-blue-500">Email</th>
                                    <th scope="col" class="bg-blue-500">Siswa_id</th>
                                    <th scope="col" class="bg-blue-500" style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($user as $users)
                                    <tr>
                                        <td>{{ $users->id }}</td>
                                        <td>{{ $users->name }}</td>
                                        <td>{{ $users->email }}</td>
                                        <td>{{ $users->siswa_id }}</td>
                                        <td class="text-center">
                                            <form class="flex flex-wrap gap-2 justify-center" onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('user.destroy', $users->id) }}" method="POST">
                                                <a href="{{ route('user.edit', $users->id) }}" class="inline-block bg-orange-400 text-white rounded px-3 py-2 m-1">Ubah </a>
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded m-1">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data User belum ada.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
            </div>
                        {{ $user->links() }}
                    </div>

@if (session('success'))
    <script>    
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: true
        });
    </script>
@elseif (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: true
        });
    </script>
@endif

</x-app-layout>