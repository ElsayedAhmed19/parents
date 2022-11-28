<?php

namespace App\Http\Controllers\Api;

use App\Contracts\UserServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ParentController extends Controller
{
    const PAGE_ELIMIT = 10;

    public function __construct(public UserServiceInterface $userService)
    { }

    public function index(Request $request)
    {
        // TODO: validate query string to prevent 500 errors
        // and making sure of query string paramters before hitting the db

        $filters['provider'] = $request->get('provider');
        $filters['statusCode'] = $request->get('statusCode');
        $filters['balanceMin'] = $request->get('balanceMin');
        $filters['balanceMax'] = $request->get('balanceMax');
        $filters['currency'] = $request->get('currency');

        // TODO: use json api to unify the response as each provider file returns a different response schema

        return response()->json([
            'status' => true,
            'data' => $this->userService->getParents($filters)
        ], Response::HTTP_OK);
    }
}
