<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use App\Services\AIService;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuestionController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $questions = Question::with(['user', 'answers'])
            ->latest()
            ->paginate(10);
            
        return view('questions.index', compact('questions'));
    }
    
    public function create()
    {
        return view('questions.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            // 'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        
        $question = Question::create([
            'user_id' => auth()->id(),
            // 'title' => $request->title,
            'body' => $request->body,
        ]);
        
        // Generate AI answer
        $aiAnswer = (new AIService())->generateAnswer($request->body);
        
        Answer::create([
            'question_id' => $question->id,
            'content' => $aiAnswer,
            'is_ai_generated' => true,
        ]);
        
        return redirect()->route('questions.show', $question);
    }
    
    public function show(Question $question)
    {
        $question->load(['answers.user', 'user']);
        return view('questions.show', compact('question'));
    }

    public function destroy(Question $question)
{
  
    $this->authorize('delete', $question);
    
    $question->delete();
    
    return redirect()->route('questions.index')
        ->with('success', 'Question deleted successfully');
}
}