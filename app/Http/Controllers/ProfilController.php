<?php

namespace App\Http\Controllers;

use App\Models\Itb;
use App\Models\User;
use App\Models\Group;
use App\Models\Student;
use App\Models\Direction;
use App\Models\Professor;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $user = $this->getUser();
        if ($user->role_id == 1) {
            return view('itb.profile.index', compact('user'));
        } elseif ($user->role_id == 2) {
            $teacher = Professor::where('user_id', '=', $user->id)->get();
            $department = $teacher[0]->getDepartment->name;
            return view('ilmiy.profile.index', compact('user', 'department'));
        } else {
            $student = Student::where('user_id', '=', $user->id)->get();
            $group_id = Group::where('id', '=', $student[0]->group_id)->get();
            Direction::all();
            $direction = $group_id[0]->getDirection->name;
            $group = $student[0]->getGroup->name;

            return view('student.profile.index', compact('user', 'direction', 'group'));
        }
    }

    public function update(Request $request)
    {

        $user = $this->getUser();

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email'
        ]);
        if ($user->role_id == 1) {
            $itb = Itb::where('user_id', '=', $user->id)->get();
            $user->update([
                'name' => $request->post('name'),
                'email' => $request->post('email')
            ]);
            $itb[0]->update([
                'name' => $request->post('name'),
                'email' => $request->post('email')
            ]);

            return back()->with('success', 'Shaxsiy ma\'lumotlaringgiz o\'zgartirildi!');
        }
        if ($user->role_id == 2) {
            $teacher = Professor::where('user_id', '=', $user->id)->get();
            $user->update([
                'name' => $request->post('name'),
                'email' => $request->post('email')
            ]);
            $teacher[0]->update([
                'name' => $request->post('name'),
                'login' => $request->post('email')
            ]);

            return back()->with('success', 'Shaxsiy ma\'lumotlaringgiz o\'zgartirildi!');
        }
        if ($user->role_id == 3) {
            $student = Student::where('user_id', '=', $user->id)->get();
            $user->update([
                'name' => $request->post('name'),
                'email' => $request->post('email')
            ]);
            $student[0]->update([
                'name' => $request->post('name'),
                'login' => $request->post('email')
            ]);

            return back()->with('success', 'Shaxsiy ma\'lumotlaringgiz o\'zgartirildi!');
        }
    }
    public function password(Request $request)
    {
        $request->validate(
            [
                'password' => 'required|min:6|confirmed'
            ],
            [
                'password.required' => 'Parol kiritilishi majburiy!',
                'password.min' => 'Parol kamida 6ta belgidan iborat bo\'lishi kerak',
                'password.confirmed' => 'Ikkita maydonga ham bir xil parol kiritilishi kerak!'
            ]
        );
        $user = $this->getUser();
        // iqtidorli talabalar bo'limini parolini o'zgartirish
        if ($user->role_id == 1) {
            $itb = Itb::where('user_id', '=', $user->id)->get();

            $user->update([
                'password' => bcrypt($request->post('password'))
            ]);
            $itb[0]->update([
                'password' => $request->post('password')
            ]);
            return back()->with('success', 'Parol muvaffaqiyatli o\'zgartirildi!');
        }
        // professorni parolini o'zgartirish
        if ($user->role_id == 2) {
            $teacher = Professor::where('user_id', '=', $user->id)->get();
            $user->update([
                'password' => bcrypt($request->post('password'))
            ]);
            $teacher[0]->update([
                'parol' => $request->post('password')
            ]);
            return back()->with('success', 'Parol muvaffaqiyatli o\'zgartirildi!');
        }
        // talabani parolini o'zgartirish
        if ($user->role_id == 3) {
            $student = Student::where('user_id', '=', $user->id)->get();
            $user->update([
                'password' => bcrypt($request->post('password'))
            ]);
            $student[0]->update([
                'parol' => $request->post('password')
            ]);
            return back()->with('success', 'Parol muvaffaqiyatli o\'zgartirildi!');
        }
    }
    private function getUser()
    {
        $id = auth()->user()->id;
        return User::findOrFail($id);
    }
}
