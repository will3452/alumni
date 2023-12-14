<?php 


namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class CompletionService {
    static function getSteps($course) {
        
        $prompt = "Please create a career progression in $course with job recommendations for each step. Start with 'Education and Skill Development,' then 'Internships or Entry-Level Positions,' 'Specialization and Advanced Learning,' 'Professional Networking and Skill Refinement,' and finally, 'Career Advancement and Leadership Roles.' After each step, list job recommendations prefaced by '!!'. Append '??' at the end of the job recommendations for each step."; 

        $result = Http::withHeaders([
                    'content-type' => 'application/json', 
                    'X-RAPIDAPI-Key' => '769c1a9f2amsh3209241d78a54dfp1ee786jsnb1dc3b089365',
                    'X-RapidAPI-Host' => 'simple-chatgpt-api.p.rapidapi.com', 
            ])->post('https://simple-chatgpt-api.p.rapidapi.com/ask', ['question' => $prompt]); 

            $answers = $result['answer']; 
            $collection = explode("??", $answers); 
            $steps = []; 
            $jobs = []; 
            foreach($collection as $key => $c) {
                $arr = explode('!!', $c); 
                $steps[$key] = array_shift($arr); 
                $jobs[$key] = implode(', ', $arr); 
            }
            for($i = 0; $i < count($steps); $i++) {
                $steps[$i] = trim($steps[$i]);
            }

        return ['steps' => $steps, 'jobs' => $jobs]; 
    }
}