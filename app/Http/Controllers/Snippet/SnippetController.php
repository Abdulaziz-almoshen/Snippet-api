<?php

namespace App\Http\Controllers\snippet;

use app\http\controllers\controller;
use App\Http\Resources\SnippetCollection;
use App\Http\Resources\SnippetResource;
use App\Http\Resources\StepResource;
use App\Http\Resources\UserResource;
use App\Snippet;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class SnippetController extends controller
{

    public function __construct()
    {
        $this->middleware(['auth:api'])->only('store'.'update');
    }

    public function index()
    {
          return new SnippetCollection(Snippet::public()->latest()->paginate(10));
    }

    public function show(Snippet $snippet)
    {
        $this->authorize('show',$snippet);
        return new SnippetResource($snippet);
    }

    public function store (Request $request)
    {
        $snippet = auth()->user()->snippets()->create();
       return  new SnippetResource($snippet);
    }

    public function update (Request $request, Snippet $snippet)
    {
        $this->authorize('update',$snippet);
        $snippet->update($request->only('title','is_public'));
        return  new SnippetResource($snippet);

    }
}
