<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TodoController extends Controller
{
     /**
     * Write code on Method
     *
     * @return response()
     */

    // Метод для получения всех задач

    public function index()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/todos');

        $jsonData = $response->json();

        dd($jsonData);
    }
}
