<?php

namespace App\Http\Controllers;

use App\Services\HelperService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EndOfTheWorldCalculation extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request, HelperService $service) : JsonResponse
    {
        $answer = $service->endOfTheWorldCalculation($request->get('leftNumber'), $request->get('rightNumber'));

        return response()->json([
            'answer' => $answer,
            'gnome' => $service->activeBackgroundGnome()
        ]);
    }
}
