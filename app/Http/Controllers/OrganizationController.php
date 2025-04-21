<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use App\Http\Requests\OrganizationStoreRequest;

class OrganizationController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return response()->json($organizations);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'boolean',
            'email' => 'required',
            'password' => 'required',
        ]);
        $org = Organization::create(
            [
                'name' => $request->name,
                'status' => $request->status,
                'email' => $request->email, 
                'password' => $request->password
            ]
        );
        return response()->json(array('success' =>200));
    }
    public function show(Organization $organization)
    {
        //
    }
    public function edit(Organization $organization)
    {
        //
    }
    public function update(Request $request, Organization $organization)
    {
        //
    }

    public function destroy(Organization $organization)
    {
        //
    }
}
