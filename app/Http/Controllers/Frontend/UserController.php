<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = User::findOrFail($id);

        return view('frontend.user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

//        return $request->all();

        $validator = Validator::make($request->only('name', 'email', 'old_password', 'password', 'password_confirmation'), [
            'name' => 'sometimes|regex:/(^([a-zA-z ]+)(\d+)?$)/u|min:5',
            'email' => 'sometimes|email|unique:users,email,'.$user->id,
            'old_password' => 'sometimes|min:8',
            'password' => 'sometimes|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->hasAny(['old_password', 'password'])) {
            $credentials = [
                'email' => $user->email,
                'password' => $request['old_password']
            ];
            if (auth()->attempt($credentials)) {
                $request->merge(['password' => bcrypt($request['password'])]);
            } else {
                session()->flash('message', 'Old password does not match');
                session()->flash('type', 'danger');
                return redirect()->back();
            }
        }

        try {
            if(auth()->user()->id == $id) {
                $user->update($request->only('name', 'email', 'password'));

                session()->flash('message', 'Profile updated successfully!');
                session()->flash('type', 'success');
                return redirect()->back();
            }

            session()->flash('message', 'You do not have permission to update!');
            session()->flash('type', 'danger');
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('message', $e->getMessage());
            session()->flash('type', 'danger');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
