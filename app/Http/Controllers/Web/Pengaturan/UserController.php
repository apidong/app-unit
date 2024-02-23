<?php

namespace App\Http\Controllers\Web\Pengaturan;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables(User::query())
                ->addIndexColumn()
                ->make(true);
        }

        return view('web.pengaturan.pengguna.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('web.pengaturan.pengguna.formCreate', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insert = $request->validate([
            'username' => 'required|regex:/^\S*$/u|min:3',
            'nama' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:5',
            'use_mobile' => 'required|integer',
        ]);
 
        User::insert([...$insert, ...['created_at' => Carbon::now(), 'email_verified_at' => Carbon::now()]]);
        $user = User::where('username', [$insert['username']])->first();

        //assign peran
        $role = Role::findById((int) $request->role);
        $user->assignRole($role);

        return redirect()->route('pengguna.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $pengguna)
    {
        $roles = Role::all();
        $rolePengguna = $pengguna->getRoleNames()->first();

        return view('web.pengaturan.pengguna.formUpdate', compact('pengguna', 'roles', 'rolePengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $pengguna)
    {
        $data = $this->validate($request, [
            'username' => ['required', 'regex:/^\S*$/u', 'min:3', Rule::unique('users', 'username')->ignore($pengguna->id)],
            'nama' => 'required|string|min:3',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($pengguna->id)],
            'password' => 'sometimes|confirmed',
            'use_mobile' => 'required|integer',
        ]);


        if ($data['password'] == null) {
            unset($data['password']);
        }

        $pengguna->update($data);

        //peran
        $existingRoles = $pengguna->getRoleNames();
        if (count($existingRoles) > 0) {
            $pengguna->removeRole($existingRoles[0]);
        }
        $role = Role::findById((int) $request->role);
        $pengguna->assignRole($role);

        return redirect()->route('pengguna.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $pengguna)
    {
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Data berhasil dihapus');
    }
}
