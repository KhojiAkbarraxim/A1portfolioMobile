<?php

namespace App\Http\Controllers\ITB;

use App\Models\Work;
use App\Models\Group;
use App\Models\Student;
use App\Models\Direction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DirectionController extends Controller
{
    public function index()
    {
        DB::statement("SET SQL_MODE=''");
        // yonalishdagi talabalarning umumiy ballini olish
        $directions = Work::leftJoin('student', 'work.student_id', 'student.id')
            ->rightJoin('group', 'student.group_id', 'group.id')
            ->rightjoin('directions', 'group.direction_id', 'directions.id')
            ->select('directions.*', DB::raw('SUM(work.score) AS score'))
            ->groupBy('directions.id')
            ->orderBy('score', 'desc')
            ->get();

        return view('itb.direction.index', compact('directions'));
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        // tekshiruv o'tkazish
        $request->validate(
            [
                'name' => 'required|min:3'
            ],
            [
                'name.required' => "Yo'nalish nomi maydoni to'ldirilishi majburiy.",
                'name.min' => "Yo'nalish nomi maydoniga kamida 3 ta harf yozishingiz kerak."
            ]
        );
        // bazaga yozish
        Direction::create([
            'name' => $request->post('name')
        ]);
        return redirect()->route('direction.index')->with('success', 'Yangi yo\'nalish qo\'shildi!');
    }
    public function show($id)
    {
        // bitta yo'nalishni olish
        $direct = Direction::findOrFail($id);
        // shu yo'nalishdagi guruhlarni olish
        if (!empty($direct->id)) {
            $groups = Group::where('direction_id', '=', $direct->id)->get();
        }
        // shu yo'nalishdagi talabarni olish
        if (!empty($groups)) {
            $studentsArray = [];
            foreach ($groups as $group) {
                $students = Student::where('group_id', '=', $group->id)->get();
                foreach ($students as $student) {
                    array_push($studentsArray, $student);
                }
            }
        }
        return view('itb.direction.show', compact('direct', 'groups', 'studentsArray'));
    }
    public function edit($id)
    {
        //     $direction = Direction::findOrFail($id);
        //     return view('itb.direction.edit', compact('direction'));
    }
    public function update(Request $request, $id)
    {
        $direction_id = Direction::findOrFail($id);
        // tekshiruv o'tkazish
        $request->validate(
            [
                'name' => 'required|min:3'
            ],
            [
                'name.required' => "Yo'nalish nomi maydoni to'ldirilishi majburiy.",
                'name.min' => "Yo'nalish nomi maydoniga kamida 3 ta harf yozishingiz kerak."
            ]
        );

        $direction_id->update([
            'name' => $request->post('name')

        ]);

        return redirect()->route('direction.index')->with('success', 'Yo\'nalish o\'zgartirildi!');
    }
    public function destroy($id)
    {
        $direction = Direction::findOrFail($id);
        $direction->delete();
        return redirect()->route('direction.index')->with('delete', 'Yo\'nalish o\'chirildi!');
    }
}
