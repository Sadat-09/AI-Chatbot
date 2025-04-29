<x-app-layout>
    <body class="bg-black font-sans text-gray-100 antialiased">

        <h1 class="text-2xl font-bold mb-6 text-black">Ask a Question</h1>
        <div class="py-12 bg-white text-black">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-700">
                        <form action="{{ route('questions.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="body" class="block text-black font-medium mb-2">ASK</label>
                                <textarea name="body" id="body" rows="6"
                                          class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-white"
                                          required></textarea>
                            </div>
                            <button type="submit" 
                                   class="bg-white text-black px-4 py-2 rounded hover:bg-blue-800">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-app-layout>
