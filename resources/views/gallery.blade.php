<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gallery</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Gallery</h1>

        <!-- Display success message if available -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display validation errors if any -->
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Upload Form -->
        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-lg rounded-lg px-8 py-6 mb-12">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Image Name</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                <textarea name="description" id="description"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-medium mb-2">Choose Image</label>
                <input type="file" name="image" id="image" accept="image/*" required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="flex items-center justify-center">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Upload Image
                </button>
            </div>
        </form>

        <!-- Display uploaded images -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($images as $image)
                <div class="bg-white rounded shadow p-4">
                    <img src="data:image/jpeg;base64,{{ $image->image }}" alt="{{ $image->name }}" class="w-full h-48 object-cover mb-2">
                    <h2 class="font-semibold text-lg">{{ $image->name }}</h2>
                    <p class="text-gray-600">{{ $image->description }}</p>
                </div>
            @endforeach
        </div>

    </div>
</body>
</html> 