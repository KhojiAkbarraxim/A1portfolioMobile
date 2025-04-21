<?php

namespace App\Http\Controllers\ITB;

use App\Models\Group;
use App\Models\Student;
use App\Models\Faculte;
use App\Models\Professor;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FacultesController extends Controller
{
    public function index()
    {
        $facultes = Faculte::all();

        return view('itb.facultes.index', compact('facultes'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:3'
            ],
            [
                'name.required' => "Fakultet nomi maydoni to'ldirilishi majburiy.",
                'name.min' => "Fakultet nomi maydoniga kamida 3 ta xarf yozishingiz kerak."

            ]
        );

        Faculte::create([
            'name' => $request->post('name')
        ]);

        return redirect()->route('faculte.index')->with('success', 'Fakultet muvaffaqiyatli qo\'shildi!');
    }
    public function show($id)
    {
        $faculte = Faculte::findOrFail($id);
        // shu id dagi kafedrani olish
        if (!empty($faculte->id)) {
            $departments = Department::where('faculte_id', '=', $faculte->id)->get();
            // dd($departments);
        }

        // shu kafedradagi professorni olish massiv
        if (!empty($departments)) {

            $professorsArray = [];

            foreach ($departments as $department) {
                $professors = Professor::where('department_id', '=', $department->id)->get();
                foreach ($professors as $professor) {
                    array_push($professorsArray, $professor->name);
                }
            }
        }

        // shu fakultetdagi guruhlarni olish
        if (!empty($faculte->id)) {
            $groups = Group::where('faculte_id', '=', $faculte->id)->get();
        }

        // fakultetdagi talabalarni olish
        if(!empty($groups)){
            $studentArray = [];
            foreach($groups as $group){
                $students = Student::where('group_id', '=', $group->id)->get();
                foreach($students as $student){
                    array_push($studentArray, $student);
                }
            }
            // dd($studentArray);
        }
        return view('itb.facultes.show', compact('faculte', 'departments', 'groups', 'professorsArray', 'studentArray'));
    }
    public function edit($id)
    {
        $faculte = Faculte::findOrFail($id);
        return view('itb.facultes.edit', compact('faculte'));
    }
    public function update(Request $request, $id)
    {
        $facult = Faculte::findOrFail($id);

        // dd($facult);

        $request->validate(
            [
                'name' => 'required|min:3'
            ],
            [
                'name.required' => "Nomi maydoni to'ldirilishi majburiy.",
                'name.min' => "Nomi maydoniga kamida 3 ta harf yozishingiz kerak."
            ]
        );
        $facult->update([
            'name' => $request->post('name')
        ]);
        return redirect()->route('faculte.index')->with('success', 'Fakultet muvaffaqiyatli saqlandi!');
    }
    public function destroy($id)
    {
        $faculte_id = Faculte::findOrFail($id);
        $faculte_id->delete();
        return redirect()->route('faculte.index')->with('delete', 'Fakultet o\'chirildi!');
    }
}
