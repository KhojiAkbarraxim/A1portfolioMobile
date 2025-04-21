<?php

namespace App\Http\Controllers\ITB;

use App\Models\Criteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CriteriaController extends Controller
{
    // Baholash mezonini yozish metodi
    public function store(Request $request){

       $mezonlar = $request->mezon;
       $balllar = $request->ball;

       for ($i=0; $i < count($mezonlar); $i++) {
        $mezon = $mezonlar[$i];
        $ball = $balllar[$i];
        Criteria::create([
            'announcement_id' => $request->id,
            'name' => $mezon,
            'ball' => $ball
        ]);
       }
       return back()->with('success', 'Baholash mezonlari qo\'shildi!');
    }
}
