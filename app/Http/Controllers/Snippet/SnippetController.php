<?php

namespace app\http\controllers\snippet;

use app\http\controllers\controller;
use App\Http\Resources\SnippetResource;
use App\Http\Resources\UserResource;
use App\Snippet;
use illuminate\http\request;
use Illuminate\Support\Str;

class SnippetController extends controller
{

    public function __construct()
    {
        $this->middleware(['auth:api'])->only('store');
    }

    public function show(Snippet $snippet)
    {
        dd($snippet);
        return new SnippetResource($snippet);
    }

    public function store (Request $request)
    {

        $snippet =auth()->user()->snippets()->create();

    }
}
