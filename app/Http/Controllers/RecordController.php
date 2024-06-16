<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class RecordController extends Controller
{
    /**
     * Zapisuje nowy rekord.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveRecord(Request $request)
    {
        // Sprawdzenie, czy żądanie zawiera nagłówek Authorization z kluczem API
        $apiKey = $request->header('Authorization');
        $apiKey = str_replace('Bearer ', '', $apiKey);

        // Wyszukanie projektu na podstawie klucza API
        $project = Project::where('key', $apiKey)->first();

        // Sprawdzenie, czy projekt został znaleziony
        if (!$project) {
            return response()->json(['error' => 'Invalid API key'], 401);
        }

        // Walidacja danych otrzymanych w żądaniu
        $validator = Validator::make($request->all(), [
            'data' => 'required|string',
            // Dodaj tutaj inne reguły walidacji, jeśli są potrzebne
        ]);

        // Sprawdzenie, czy walidacja zakończyła się sukcesem
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Utworzenie nowego rekordu i zapisanie go w bazie danych
        $record = new Record();
        $record->project_id = $project->id;
        $record->data = $request->data;
        // Dodaj tutaj inne pola rekordu, jeśli są potrzebne
        $record->save();

        // Zwrócenie odpowiedzi potwierdzającej zapisanie rekordu
        return response()->json(['message' => 'Record saved successfully'], 200);
    }
}
