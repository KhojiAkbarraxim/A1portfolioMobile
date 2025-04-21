<?php

namespace App\Http\Controllers\ITB;

use App\Models\Work_type;
use App\Models\WorkScale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Work_typeController extends Controller
{
    public function index()
    {
        $scale = WorkScale::all();
        $worktype = Work_type::join('work_scale', 'work_type.scale_id', '=', 'work_scale.id')
                        ->select(['work_type.*', 'work_scale.name as scale'])
                        ->get();

                return view('itb.work_type.index', compact('worktype', 'scale'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $request -> validate([
            'scale_id' => 'required',
            'name' => 'required|min:3'
        ]);

        Work_type::create([
            'scale_id' => $request->post('scale_id'),
            'name' => $request->post('name')
        ]);

        return redirect()->route('worktype.index')->with('success', 'Portfolio turi qo\'shildi!');
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
        $type = Work_type::findOrFail($id);
        $request -> validate([
            'scale_id' => 'required',
            'name' => 'required|min:3'
        ]);

        $type->update([
            'scale_id' => $request->post('scale_id'),
            'name' => $request->post('name')
        ]);

        return redirect()->route('worktype.index')->with('success', 'Portfolio turi o\'zgartirildi!');
    }
    public function destroy($id)
    {
        $type = Work_type::findOrFail($id);
        $type->delete();
        return redirect()->route('worktype.index')->with('delete', 'Tanlagan portfolio turi o\'chirildi!');
    }
}
