<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteBookResourse;
use App\Models\NoteBook;
use Illuminate\Http\Request;
use App\Models\ApiService;

class NoteBookController extends Controller
{
    public function __construct(ApiService $apiService,)
    {
        $this->ApiService = $apiService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->ApiService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->ApiService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->ApiService->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->ApiService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->ApiService->destroy($id);
    }
}
