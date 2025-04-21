<?php

namespace App\Http\Controllers\ITB;

use App\Models\User;
use App\Models\Attach;
use App\Models\Student;
use App\Models\Professor;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RedirectIfAuthenticated;

class ProfessorController extends Controller
{
    private const TEACHER = 2;

    public function index()
    {
        $professors = Professor::all();
        $departments = Department::all();

        return view('itb.professor.index', compact('professors', 'departments'));
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
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3',
                'department_id' => 'required'
            ],
            [
                'name.required' => 'Ism familyasi yozilishi majburiy!',
                'name.min' => 'Ism familyasi kamida 3ta harf bo\'lishi kerak!',
                'email.email' => 'Loginda "@" belgisi qatnashishi majburiy!',
                'email.required' => 'Login kiritilishi majburiy!',
                'password.required' => 'Parol yozilishi majburiy!',
                'password.min' => 'Parol kamida 3ta belgi bo\'lishi kerak!',
                'email.unique' => 'Bu email orqali oldin ro\'yhatdan o\'tilgan'

            ]
        );

        User::create([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => Hash::make($request['password']),
            'role_id' => self::TEACHER
        ]);

        $users = User::where('email', '=', $request->email)->get();
        $users_array = json_decode($users);
        $user_id = $users_array[0]->id;


        Professor::create([
            // 'name' => $request->post('name'),
            // 'login' => $request->post('email'),
            // 'parol' => $request->post('password'),
            'department_id' => $request->post('department_id'),
            'user_id' => $user_id
        ]);

        return redirect()->route('professor.index')->with('success', 'Ilmiy rahbar muvaffaqiyatli qo\'shildi!');
    }
    public function show($id)
    {
        $professor = Professor::findOrFail($id);
        // dd(empty($professor->getDepartment->name));

        $students = Student::where('attach_status', '=', false)->get();
        // Biriktirilgan talabalarning  olish
        $studentsArray = Attach::where('teacher_id', '=', $professor->id)
            ->join('student', 'attach.student_id', '=', 'student.id')
            ->join('group', 'student.group_id', '=', 'group.id')
            ->select(['student.*', 'group.name AS group'])
            ->get();

        return view('itb.professor.show', compact('professor', 'students', 'studentsArray'));
    }
    public function edit($id)
    {
        $professor = Professor::findOrFail($id);
        $departments = Department::all();
        return view('itb.professor.edit', compact('professor', 'departments'));
    }
    public function update(Request $request, $id)
    {
        $professor = Professor::findOrFail($id);


        $request->validate(
            [
                'name' => 'required|min:3',
                'email' => 'required|email',
                'password' => 'required|min:3',
                'department_id' => 'required'
            ],
            [
                'name.required' => 'Ism familyasi yozilishi majburiy!',
                'name.min' => 'Ism familyasi kamida 3ta harf bo\'lishi kerak!',
                'email.email' => 'Loginda "@" belgisi qatnashishi majburiy!',
                'email.required' => 'Login kiritilishi majburiy!',
                'password.required' => 'Parol yozilishi majburiy!',
                'password.min' => 'Parol kamida 3ta belgi bo\'lishi kerak!',
                'email.unique' => 'Bu email orqali oldin ro\'yhatdan o\'tilgan'

            ]
        );
        // userni idisni olish
        $users = User::where('id', '=', $professor->user_id)->get();
        $user_id = $users[0]->id;

        // userni o'zgartirish
        $users[0]->update([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'password' => Hash::make($request['password']),
            'role_id' => self::TEACHER
        ]);

        $professor->update([
            // 'name' => $request->post('name'),
            // 'login' => $request->post('email'),
            // 'parol' => $request->post('password'),
            'department_id' => $request->post('department_id'),
            'user_id' => $user_id
        ]);

        return redirect()->route('professor.index')->with('success', 'Ilmiy rahbar ma\'lumotlari muvaffaqiyatli o\'zgartirildi!');
    }
    public function destroy($id)
    {
        $professor = Professor::findOrFail($id);
        $user = User::where('id', '=', $professor->user_id)->get();
        if ($professor->status == 1) {

            $professor->update([
                'status' => false
            ]);
            $user[0]->update([
                'status' => false
            ]);
            return redirect()->route('professor.index')->with('delete', 'Ilmiy rahbar bloklandi');
        } else {
            $professor->update([
                'status' => true
            ]);
            $user[0]->update([
                'status' => true
            ]);
        }

        return redirect()->route('professor.index')->with('success', 'Ilmiy rahbar faollashdi');
    }

    public function attach_student(Request $request, $id)
    {
        $professor = Professor::findOrFail($id);
        $student = Student::where('id', '=', $request->student_id)->get();
        // dd($student[0]->attach_status);
        $request->validate(
            [
                'student_id' => 'required'
            ],
            [
                'student_id.required' => 'Talaba tanlanmadi. Iltimos talabani tanlang!'
            ]
        );

        $student[0]->update([
            'attach_status' => true
        ]);

        Attach::create([
            'student_id' => $request->post('student_id'),
            'teacher_id' => $professor->id
        ]);

        return redirect()->back()->with('success', $professor->name . 'ga' . ' ' . $student[0]->name . ' biriktirildi!');
    }
}
