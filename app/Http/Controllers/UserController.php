<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthController;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id')->get();
        return view('user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = new User;
        return view('auth.register')->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $authController = new AuthController();

        $validator = $authController->validator(Input::all(), true);

        // process the login
        if ($validator->fails()) {
            return redirect()
                ->route('user.create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $user = $authController->create(Input::all());

            return redirect()
                ->route('user.edit', ['id' => $user->id]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('auth.register')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return $this->index();
    }
}
