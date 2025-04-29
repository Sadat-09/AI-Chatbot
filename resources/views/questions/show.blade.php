<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#1f1f1f] shadow-lg rounded-lg p-6 border border-gray-700">
                <a href="{{ route('questions.index') }}"
                   class="text-blue-400 hover:text-blue-300 mb-6 inline-block text-sm">
                    ← Back to Questions
                </a>

                <h1 class="text-3xl font-bold text-white mb-2">{{ $question->title }}</h1>

                <div class="flex justify-between items-center text-sm text-gray-400 mb-6">
                    <span>Asked by <span class="text-blue-400">{{ $question->user->name ?? 'Guest' }}</span></span>
                    <span>{{ $question->created_at->diffForHumans() }}</span>
                </div>

                <div class="bg-[#2a2a2a] text-gray-200 p-4 rounded-lg mb-8 border border-gray-600">
                    {!! nl2br(e($question->body)) !!}
                </div>

                <h2 class="text-2xl text-white font-semibold mb-4">Answers</h2>

                @forelse ($question->answers as $answer)
                    <div class="mb-6 p-4 rounded-lg border 
                        {{ $answer->is_ai_generated ? 'bg-[#0d1117] border-blue-600' : 'bg-[#2a2a2a] border-gray-600' }}">
                        
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-medium text-white">
                                @if($answer->is_ai_generated)
                                    🤖 <span class="text-blue-400">AI Assistant</span>
                                @else
                                    👤 <span class="text-green-400">{{ $answer->user->name }}</span>
                                @endif
                            </span>
                            <span class="text-sm text-gray-400">
                                {{ $answer->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <div class="text-gray-200 whitespace-pre-line leading-relaxed">
                            {!! nl2br(e($answer->content)) !!}
                        </div>
                    </div>
                @empty
                    <div class="text-gray-400">No answers yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
