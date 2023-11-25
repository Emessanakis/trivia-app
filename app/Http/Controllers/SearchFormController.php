<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\SearchHistory;

class SearchFormController extends Controller
{
    public function index()
    {
        return view('search-form');
    }

    public function processForm(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email_address' => 'required|email',
            'questions_amount' => 'required|numeric|min:1|max:50',
            'select_difficulty' => 'in:any,easy,medium,hard',
            'select_type' => 'in:any,multiple,boolean',
        ]);
        
    // Store the valid search in the search_history table
    SearchHistory::create($request->all());

        // Build the API request URL
        $apiUrl = 'https://opentdb.com/api.php';
        $apiParams = [
            'amount' => $request->input('questions_amount'),
            'difficulty' => $request->input('select_difficulty'),
            'type' => $request->input('select_type'),
        ];
    
        // Display the API request URL
        $apiUrlWithParams = $apiUrl . '?' . http_build_query($apiParams);
        // Use GuzzleHttp for the HTTP request with SSL verification
        $client = new Client([
            'verify' => app_path('Certificate/cacert.pem'),
        ]);
    
        // Make API request to OpenTDB
        $apiResponse = $client->get($apiUrl, ['query' => $apiParams]);
    
        // Handle the API response
        if ($apiResponse->getStatusCode() === 200) {
            $triviaQuestions = json_decode($apiResponse->getBody(), true);
    
            // Filter out questions from the specified category
            $filteredQuestions = array_filter($triviaQuestions['results'], function ($question) {
                return $question['category'] !== 'Entertainment: Video Games';
            });
    
            // Sort the remaining questions by category
            usort($filteredQuestions, function ($a, $b) {
                return strcmp($a['category'], $b['category']);
            });
            // Display the trivia-questions.blade.php view
            return view('trivia-questions', compact('filteredQuestions', 'apiUrlWithParams'));
        } else {
            // Handle the error, for example, redirect back with an error message
            return redirect()->back()->with('error', 'Failed to fetch trivia questions from the API.');
        }
    }
    
}