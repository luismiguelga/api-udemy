<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Laravel\Passport\ClientRepository;

class ClientController extends Controller
{
    public function index()
    {
        $users = Client::all();
        return view('clients.index', compact('users'));
    }

    public function store(Request $request)
    {
        $response = $request->all();

        $user = auth()->user();

        $client = app(ClientRepository::class)->createAuthorizationCodeGrantClient(
            user: $user,
            name: $response['name'],
            redirectUris: [$response['redirect']],
            confidential: false,
            enableDeviceFlow: true
        );
    }
}
