<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Patrones\Permiso;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('administrador')->except(['show']);
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->all();

        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    private function subirArchivo($file)
    {
        if (is_null($file)) {
            Flash::error('Elija imagenes validas. (*.jpg | *.jpeg | *.png)');
            return redirect(route('users.show'));
        }
        $nombreArchivo = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images_user'), $nombreArchivo);
        return $nombreArchivo;
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $input = $request->all();

            $input['password'] = \Hash::make($request->password);
            $input['alta'] = true;
            if (isset($input['foto_input']))
                $input['fotografia'] = $this->subirArchivo($input['foto_input']);
            else
                $input['fotografia'] = 'foto_base.png';

            $user = $this->userRepository->create($input);

            Flash::success('User saved successfully.');

            return redirect(route('users.index'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        $user = $this->userRepository->find($id);

        $this->authorize('show', $user);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $input = $request->all();
        $input['password'] = \Hash::make($request->password);
        if (isset($input['foto_input']))
            $input['fotografia'] = $this->subirArchivo($input['foto_input']);
        $user = $this->userRepository->update($input, $id);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    public function updateFoto($id, Request $request)
    {
        $user = $this->userRepository->find($id);
        $input = $request->all();
        if (isset($input['foto_input']))
            $input['fotografia'] = $this->subirArchivo($input['foto_input']);
        $user = $this->userRepository->update($input, $id);

        Flash::success('Actualizado correctamente!.');

        return redirect()->route('users.show', array('id' => $user->id));
    }

    public function updatePassword($id, Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:5|max:20|confirmed',
        ]);

        $user = $this->userRepository->find($id);

        $input = $request->all();
        $input['password'] = \Hash::make($request->password);

        //verificando si la contrasena actual es la correcta
        if (!\Hash::check($request->old_password, \Auth::user()->password)) {
            Flash::error('El password actual no es la correcta!.');
            return redirect()->route('users.show', array('id' => $user->id));
        }

        $user = $this->userRepository->update($input, $id);
        Flash::success('Actualizado correctamente!.');
        return redirect()->route('users.show', array('id' => $user->id));
    }
}
