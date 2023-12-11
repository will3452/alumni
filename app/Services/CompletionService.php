<?php 


namespace App\Services;

use Illuminate\Support\Facades\Http;

class CompletionService {
    static function getSteps($course) {
        
        $prompt = "please generate career 5 steps for $course, order is must. separate each steps by '??' and result only no more instructions or words."; 

        $result = Http::withHeaders([
                    'content-type' => 'application/json', 
                    'X-RAPIDAPI-Key' => '769c1a9f2amsh3209241d78a54dfp1ee786jsnb1dc3b089365',
                    'X-RapidAPI-Host' => 'simple-chatgpt-api.p.rapidapi.com', 
            ])->post('https://simple-chatgpt-api.p.rapidapi.com/ask', ['question' => $prompt]); 

            $answers = $result['answer']; 
            $steps = explode("??", $answers); 
            for($i = 0; $i < count($steps); $i++) {
                $steps[$i] = trim($steps[$i]);
            }

        return $steps; 
    }
}