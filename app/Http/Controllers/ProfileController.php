<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('profile.index', [
            'user' => $user
        ]);
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $user = User::where('email', $request->email)->first();
            $user->name = $request->name;
            $user->tanggal_lahir = $request->tanggal_lahir;
            $user->no_hp = $request->no_hp;
            $user->save();

            DB::commit();
            return redirect()->back()->with('success', 'Your Profile has been updated.');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan');
        }
    }
}
