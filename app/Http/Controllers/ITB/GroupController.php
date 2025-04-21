<?php

namespace App\Http\Controllers\ITB;

use App\Models\Group;
use App\Models\Student;
use App\Models\Faculte;
use App\Models\Direction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        $facultes = Faculte::all();
        $directions = Direction::all();
        return view('itb.group.index', compact('groups', 'facultes', 'directions'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:3',
                'faculte_id' => 'required',
                'direction_id' => 'required'
            ],
            [
                'name.required' => 'Guruh nomi kiritilishi majburiy!',
                'name.min' => 'Nomi kamida 3ta belgidan iborat bo\'lishi kerak!'
            ]
        );

        Group::create([
            'name' => $request->post('name'),
            'faculte_id' => $request->post('faculte_id'),
            'direction_id' => $request->post('direction_id')
        ]);

        return redirect()->route('group.index')->with('success', 'Guruh muvaffaqiyatli qo\'shildi');
    }
    public function show($id)
    {
        $group = Group::findOrFail($id);

        if (!empty($group->id)) {
            $students = Student::where('group_id', '=', $group->id)->get();
        }

        return view('itb.group.show', compact('group', 'students'));
    }    public function edit($id)
    {
        $group = Group::findOrFail($id);
        $facultes = $this->getFaculte();
        $directions = $this->getDirection();
        return view('itb.group.edit', compact('group', 'facultes', 'directions'));
    }
    public function update(Request $request, $id)
    {
        $group_id = Group::findOrFail($id);
        $request->validate(
            [
                'name' => 'required|min:3',
                'faculte_id' => 'required',
                'direction_id' => 'required'
            ],
            [
                'name.required' => 'Guruh nomi kiritilishi majburiy!',
                'name.min' => 'Nomi kamida 3ta belgidan iborat bo\'lishi kerak!'
            ]
        );

        $group_id->update(
            [
                'name' => $request->post('name'),
                'faculte_id' => $request->post('faculte_id'),
                'direction_id' => $request->post('direction_id')

            ]
        );
        return redirect()->route('group.index')->with('success', 'Guruh muvaffaqiyatli o\'zgartirildi');
    }
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();
        return redirect()->route('group.index')->with('delete', 'Siz tanlagan guruh o\'chirildi!');
    }
    private function getFaculte()
    {
        return Faculte::all();
    }
    private function getDirection()
    {
        return Direction::all();
    }
}
