<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;
use Laravel\Passport\Token;

class TokenController extends Controller
{
    public function index(Request $request): mixed
    {

        if ($request->expectsJson()) {
            $tokens = Token::all();

            return response()->json($tokens);
        }

        return view('tokens.index');
    }

    public function store(Request $request): void
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'scopes' => 'nullable|array|',
        ]);

        auth()->user()->createToken(
            $data['name'],
            $data['scopes'] ?? []
        );

    }

    public function destroy(Token $token): void
    {
        $token->delete();
    }

    public function show(Token $token): JsonResponse
    {
        return response()->json($token);
    }

    public function getScopes()
    {
        return response()->json(Passport::scopes());
    }
}
