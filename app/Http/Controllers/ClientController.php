<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Passport\ClientRepository;

class ClientController extends Controller
{
    public function index(Request $request): mixed
    {
        if ($request->expectsJson()) {
            $clients = Client::all();

            return response()->json($clients);
        }

        return view('clients.index');
    }

    public function store(Request $request): void
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'redirect_uris' => 'required',
        ]);

        $response = $request->all();

        $user = auth()->user();

        app(ClientRepository::class)->createAuthorizationCodeGrantClient(
            user: $user,
            name: $response['name'],
            redirectUris: [$response['redirect_uris']],
            confidential: false,
            enableDeviceFlow: true
        );
    }

    public function destroy(Client $client)
    {
        $client->delete();
    }

    public function edit(Client $client): JsonResponse
    {
        return response()->json($client);
    }

    public function update(Client $client, Request $request): void
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'redirect_uris' => 'required',
        ]);

        $client->update([
            'name' => $request->input('name'),
            'redirect_uris' => $request->input('redirect_uris'),
        ]);
    }

    public function show(Client $client)
    {
        $client->makeVisible('secret');
        return response()->json($client);
    }
}
