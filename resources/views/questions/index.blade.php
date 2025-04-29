<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <button onclick="window.location='{{ route('questions.create') }}'" 
                        class="bg-white-500 hover:bg-blue-700 text-black font-bold text-lg px-6 py-3 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Ask New Question
                    </button>
                    <h1 class="text-2xl font-bold mb-6">Recent Questions</h1>

                    
                    @foreach ($questions as $question)
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-xl font-semibold">
                                    <a href="{{ route('questions.show', $question) }}" 
                                       class="text-blue-600 hover:text-blue-800">
                                       <p class="text-gray-600 mb-2"><strong>{{ Str::limit($question->body, 200) }}</strong></p>
                                    </a>
                                </h2>
                               
                                <div class="text-sm text-gray-500">
                                    <span>Asked by {{ $question->user->name }}</span>
                                    <span>{{ $question->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            @auth
                                <form method="POST" action="{{ route('questions.destroy', $question) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-500 hover:text-red-700 text-sm font-medium"
                                            onclick="return confirm('Are you sure you want to delete this question?')">
                                        Delete
                                    </button>
                                </form>
                            @endauth
                        </div>
                    </div>
                    @endforeach

                    {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>