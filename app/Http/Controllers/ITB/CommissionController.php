<?php

namespace App\Http\Controllers\ITB;

use App\Models\Commission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommissionController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'phone' => 'required|min:9|max:9'
        ],
        [
            'name.required' => 'Ism familyasi yozilishi majburiy!',
            'name.min' => 'Ism familyasi kamida 3ta harf bo\'lishi kerak!',
            'phone.required' => 'Telefon raqam kiritilishi majburiy!',
            'phone.min' => 'Telefon raqam kamida 9ta raqam bo\'lishi kerak!',
            'phone.max' => 'Telefon raqam 9ta raqamdan oshmasligi kerak'
        ]);

        Commission::create([
            'announcement_id' => $request->post('id'),
            'name' => $request->post('name'),
            'phone' => '+998'.$request->post('phone')
        ]);
        return back()->with('success', 'Tanlovga kommissiya a\'zosi qo\'shildi!');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
