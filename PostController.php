<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */

    // Метод получения всех постов

    public function index()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        $jsonData = $response->json();

        dd($jsonData);
    }
    // Метод обновления title и body в посте с id равным 1

    public function update()
    {
        $response = Http::put('https://jsonplaceholder.typicode.com/posts/1', [
                    'title' => 'This is test from polis812.ru',
                    'body' => 'This is test from polis812.ru as body',
                ]);

        $jsonData = $response->json();

        dd($jsonData);
    }

    // Метод добавления нового поста в конец списка с id равным 101

    public function store()
    {
        $response = Http::post('https://jsonplaceholder.typicode.com/posts', [
                    'title' => 'This is test from polis812.ru',
                    'body' => 'This is test from polis812.ru as body',
                ]);

        $jsonData = $response->json();

        dd($jsonData);
    }

    // Метод для удаления поста с id равным 1

    public function delete()
    {
        $response = Http::delete('https://jsonplaceholder.typicode.com/posts/1');

        $jsonData = $response->json();

        dd($jsonData);
    }
}
