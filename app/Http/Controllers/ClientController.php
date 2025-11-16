<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\ApiResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // check if the token is valid allow this response
        if (!auth()->user()->tokenCan('clients.index')) {
            return ApiResponse::error('Unauthorized', 401);
        }

        // return all clients
        return ApiResponse::success(Client::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:20',
        ]);

        // add new client
        $client = Client::create($validated);

        return ApiResponse::success($client);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // check if the token is valid allow this response
        if (!auth()->user()->tokenCan('clients.show')) {
            return ApiResponse::error('Unauthorized', 401);
        }

        //show client by id
        $client = Client::find($id);

        // return a response
        if ($client) {
            return ApiResponse::success($client);
        } else {
            return ApiResponse::error('Client not found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
            'phone' => 'nullable|string|max:20',
        ]);

        //update client
        $client = Client::find($id);
        if ($client) {
            $client->update($validated);
            return ApiResponse::success($client);
        } else {
            return ApiResponse::error('Client not found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete client by id
        $client = Client::find($id);
        if ($client) {
            $client->delete();
            return ApiResponse::success('Client deleted successfully');
        } else {
            return ApiResponse::error('Client not found', 404);
        }
    }
}
