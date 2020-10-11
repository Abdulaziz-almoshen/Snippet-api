<?php

namespace app\http\controllers\snippet;

use app\http\controllers\controller;
use App\Http\Resources\SnippetResource;
use App\Http\Resources\StepResource;
use App\Http\Resources\UserResource;
use App\Snippet;
use Illuminate\Http\Request;
//use illuminate\http\request;
use Illuminate\Support\Str;

class SnippetController extends controller
{

    public function __construct()
    {
        $this->middleware(['auth:api'])->only('store');
    }

    public function show(Snippet $snippet)
    {
        return new SnippetResource($snippet);
    }

    public function store (Request $request)
    {
        $snippet = auth()->user()->snippets()->create();
       return  new SnippetResource($snippet);

    }

    public function update (Request $request, Snippet $snippet)
    {
//        dd($request->all());
        $snippet->update($request->only('title'));
        return  new SnippetResource($snippet);

    }
}
