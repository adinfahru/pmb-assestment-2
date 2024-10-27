<x-app-layout>
    <div class="container mx-auto h-full">
        <div class="py-8 px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($fotos as $foto)
                <div class="mb-3">
                    <div class="card bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $foto->file_path) }}" alt="Foto" class="w-full h-auto max-w-xs mx-auto"> <!-- Center the image and set max width -->
                        <div class="p-4 text-sm text-center"> <!-- Centered text -->
                            <a href="{{ route('foto.edit', $foto->id) }}" class="px-4 py-2 text-white bg-blue-500 font-bold rounded-md hover:bg-blue-700">Edit</a>
                            <form action="{{ route('foto.destroy', $foto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 text-white bg-red-500 font-bold rounded-md hover:bg-red-700">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @if ($fotos->isEmpty())
        <a href="{{ route('foto.create') }}" class="px-4 py-2 text-white bg-blue-500 font-bold rounded-md hover:bg-blue-700">Upload Foto</a>
        @endif
    </div>
</x-app-layout>