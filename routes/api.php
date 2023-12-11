<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/test', function(Request $request) {
    $token = "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"; 
    return Http::withHeaders(['Authorization' => "Bearer $token"])->post('https://api.openai.com/v1/completions', [
        'prompt' => 'hello',
        'model' => 'text-davinci-003', 
    ]); 
}); 


Route::get('/generate-steps', function(Request $request) {
    $course = $request->course; 
    $prompt = "please generate career steps for $course, order is must. separate each steps by '??'  and result only no more instructions or words."; 

    $result = Http::withHeaders([
        'content-type' => 'application/json', 
        'X-RAPIDAPI-Key' => '4c0e84dec6msh5e4870cd1495469p18c784jsn81085763ba8a',
        'X-RapidAPI-Host' => 'simple-chatgpt-api.p.rapidapi.com', 
    ])->post('https://simple-chatgpt-api.p.rapidapi.com/ask', ['question' => $prompt]); 

    $answers = $result['answer']; 
    $steps = explode("??", $answers); 
    for($i = 0; $i < count($steps); $i++) {
        $steps[$i] = trim($steps[$i]);
    }
    return $steps; 
}); 
