<?php

namespace App\Http\Controllers\ITB;

use App\Models\Faculte;
use App\Models\Professor;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $facultes = Faculte::all();

        return view('itb.department.index', compact('departments', 'facultes'));
    }
    public function create()
    {
        $facultes = $this->getFaculte();
        return redirect()->route('itb.home', compact('facultes'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'faculte_id' => 'required',
                'name' => 'required|min:3'
            ],
            [
                'name.required' => 'Kafedra nomi kiritilishi majburiy',
                'name.min' => 'Kafedra nomi kamida 3ta harf bo\'lishi kerak'
            ]
        );

        Department::create([
            'faculte_id' => $request->post('faculte_id'),
            'name' => $request->post('name')
        ]);

        return redirect()->route('department.index')->with('success', 'Yangi kafedra muvaffaqiyatli qo\'shildi!');
    }
    public function show($id)
    {
        $department = Department::findOrFail($id);

        if (!empty($department->id)) {
            $professors = Professor::where('department_id', '=', $department->id)->get();
        }


        return view('itb.department.show', compact('department', 'professors'));
    }
    public function edit($id)
    {
        // $department = Department::findOrFail($id);
        // $facultes = $this->getFaculte();
        // return view('itb.department.edit', compact('department', 'facultes'));
    }
    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $request->validate(
            [
                'faculte_id' => 'required',
                'name' => 'required|min:3'
            ],
            [
                'name.required' => 'Kafedra nomi kiritilishi majburiy',
                'name.min' => 'Kafedra nomi kamida 3ta harf bo\'lishi kerak'
            ]
        );

        $department->update([
            'faculte_id' => $request->post('faculte_id'),
            'name' => $request->post('name')
        ]);

        return redirect()->route('department.index')->with('success', 'Kafedra o\'zgartirildi!');
    }
    public function destroy($id)
    {
        $id = Department::findOrFail($id);
        $id->delete();
        return redirect()->route('department.index')->with('delete', 'Kafedra o\'chirildi!');
    }

    private function getFaculte()
    {
        return Faculte::all();
    }
}
