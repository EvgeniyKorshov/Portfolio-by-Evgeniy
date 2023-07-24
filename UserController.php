<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
     /**
     * Write code on Method
     *
     * @return response()
     */

     // Метод для получения всех юзеров

    public function index()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/users');

        $jsonData = $response->json();

        dd($jsonData);
    }
}
