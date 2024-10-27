<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Edit Foto</h1>

        <form action="{{ route('foto.update', $foto->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="file" class="block text-gray-700 text-sm font-bold mb-2">Pilih Foto (kosongkan jika tidak ingin mengubah)</label>
                <input type="file" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500" id="file" name="file">
            </div>
            <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md transition duration-200">Update</button>
        </form>
    </div>
</x-app-layout>