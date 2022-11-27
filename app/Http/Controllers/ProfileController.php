<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

use App\Models\Person as Model;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $person = Model::where('user_id', $user->id)->first();

        return view('profile', ['data' => $person]);
    }

    public function store(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:person,email,'.$id],
            'phone' => ['required', 'string', 'max:12'],
            'address' => ['required', 'string', 'max:255']
        ]);

        $person = Model::findOrNew($id);
        $person->name = $request->name;
        $person->email = $request->email;
        $person->phone = $request->phone;
        $person->address = $request->address;
        $person->save();

        if(!empty($person)){
            $user = User::findOrNew($person->users->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
        }

        return view('profile', ['data' => $person, 'status' => 'Data Has Been Saved !']);
    }
}
