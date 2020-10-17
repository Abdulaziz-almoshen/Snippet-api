<?php

namespace app\http\controllers\snippet;

use App\Http\Controllers\Controller;
use App\Http\Resources\SnippetResource;
use App\Http\Resources\StepResource;
use App\Snippet;
use App\Step;
use Illuminate\Http\Request;


class StepController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api'])->only('store');
    }

    public function update (Request $request, Snippet $snippet, Step $step)
    {

        $step->update($request->only('title','body'));
        return  new StepResource($step);

    }

    public function store(Snippet $snippet , Request $request)
    {

        $step = $snippet->steps()->create(array_merge
        ($request->only('title','body'),
        ['order' =>$this->getOrder($request)]));
        return new StepResource($step);
    }

    protected function getOrder (Request $request){
        return Step::where('uuid', $request->before)
            ->orwhere('uuid', $request->after)
            ->first()
            ->{($request->after ? 'after' : 'before').'Step'}();
    }


}
