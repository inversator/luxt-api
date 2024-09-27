<?php

namespace App\Http\Controllers;

use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => ResponseStatus::Success->value,
            'pages' => 'just check'
            ]);
    }
}
