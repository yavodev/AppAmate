<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function pacientesindex()
    {
        return view('admin.users.pacientesindex');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function getUsuarios()
    {
        $data = array();
        $usuarios = User::with('roles')->whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['Admin', 'Usuario']);
        })->get();
        foreach ($usuarios as $key => $value) {
            foreach ($value['roles'] as $key => $item) {
                $rol = $item->name;
            }

            $class_status = ($value->status == 1) ? "success" : "danger";
            $text_status = ($value->status == 1) ? "Activo" : "Inactivo";

            $ruta_editar = route('usuarios.edit', $value->id);

            $info = [
                '<img src="' . $value->image . '" alt="image"/>',
                $value->name,
                $value->email,
                $rol,
                '<span class="badge bg-' . $class_status . '">' . $text_status . '</span>',
                //date("Y-m-d H:m", strtotime($value->created_at)),
                '
                <a href="' . $ruta_editar . '" class="btn btn-xs btn-success"><i class="mdi mdi-border-color"></i> Editar</a>
                <button type="button" class="btn btn-xs btn-danger" onclick="eliminarUsuario(' . $value->id . ');"><i class="mdi mdi-delete-forevermdi mdi-delete-forever"></i>Eliminar</button>
                '
            ];

            $data[] = $info;
        }

        echo json_encode([
            'data' => $data
        ]);
    }

    public function getUsuarios2()
    {
        $data = array();
        $usuarios = User::with('roles')->whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['Admin', 'Juidico', 'Psicologo']);
        })->get();
        foreach ($usuarios as $key => $value) {

            $class_status = ($value->status == 1) ? "success" : "danger";
            $text_status = ($value->status == 1) ? "Activo" : "Inactivo";

            $ruta_ver = route('test.detalles', $value->id);
            $img = '';
            if ($value->image == null) {
                $img = '<img src="images/auth/user.png" alt="image"/>';
            } else {
                $img = '<img src="' . $value->image . '" alt="image"/>';
            }

            $info = [
                $img,
                $value->name,
                $value->email,
                '<span class="badge bg-' . $class_status . '">' . $text_status . '</span>',
                '
                <a href="' . $ruta_ver . '" class="btn btn-success"><i class="mdi mdi-eye"></i></a>
                '
            ];

            $data[] = $info;
        }

        echo json_encode([
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $error = false;
        $mensaje = '';

        $email = $request->email;
        $name = $request->name;
        $lastname = $request->lastname;
        $identification = $request->identification;
        $rol = $request->appointment;
        $area = $request->area;

        //consulta para validar si ya existe un usuario registrado o no
        $validar_email = User::where('email', $email)->count();
        $validar_identify = User::where('identification', $identification)->count();

        if ($validar_email > 0) {
            $error = true;
            $mensaje = 'Error! Ya se encuentra registrado un usuario con este correo electrónico "' . $email . '". Intente con otro.';
        } else if ($validar_identify > 0) {
            $error = true;
            $mensaje = 'Error! Ya se encuentra registrado un usuario con esta identificación "' . $identification . '".';
        } else {
            # validamos si existe la imagen en el request
            $image = $request->file('imgLogo')->store('public/imagenesprofesionales');
            $url = Storage::url($image);

            $register_user = array(
                'name' => $name,
                'lastname' => $lastname,
                'identification' => $identification,
                'area' => $area,
                'image' => $url,
                'email' => $email,
                'password' => Hash::make($identification),
                'status' => 1
            );

            if ($user_add = User::create($register_user)->assignRole($rol)) {
                $error = false;
                $mensaje = 'Registro Exitoso!';
            } else {
                $error = true;
                $mensaje = 'Error! Se presento un problema al registras datos de usuario, intenta de nuevo';
            }
        }
        echo json_encode(array('error' => $error, 'mensaje' => $mensaje));
    }

    public function update(Request $request)
    {
        $error = false;
        $mensaje = '';

        $id = $request->id;
        $email = $request->email;
        $name = $request->name;
        $lastname = $request->lastname;
        $identification = $request->identification;
        $area = $request->area;
        $discapacity = $request->discapacity;

        $user = User::find($id);

        //consulta para validar si ya existe un usuario registrado o no
        $validar_email = User::where('email', $email)->where('id', '<>', $id)->exists();
        $validar_identify = User::where('identification', $identification)->where('id', '<>', $id)->exists();

        if ($validar_email) {
            $error = true;
            $mensaje = 'Error! Ya se encuentra registrado un usuario con este correo electrónico "' . $email . '". Intente con otro.';
        } else if ($validar_identify) {
            $error = true;
            $mensaje = 'Error! Ya se encuentra registrado un usuario con esta identificación "' . $identification . '".';
        } else {
            # validamos si existe la imagen en el request
            $image = '';
            $url = '';
            if ($request->has('imgLogo')) {
                if ($user->hasRole('Juidico') || $user->hasRole('Psicologo')) {
                    $image = $request->file('imgLogo')->store('public/imagenesprofesionales');
                } else if ($user->hasRole('Usuario')) {
                    $image = $request->file('imgLogo')->store('public/imagenesusuarios');
                } else {
                    $image = $request->file('imgLogo')->store('public/imagenadmin');
                }
                $url = Storage::url($image);
            }




            $actualizar = array(
                'name' => $name,
                'lastname' => $lastname,
                'identification' => $identification,
                'area' => $area,
                'email' => $email,
                'discapacity' => $discapacity,
            );
            if (isset($request->imgLogo)) {
                $actualizar['image'] = $url;
            }

            if (User::findOrFail($id)->update($actualizar)) {
                $error = false;
            } else {
                $error = true;
                $mensaje = 'Error! Se presento un problema al actualizar los datos, intenta de nuevo';
            }
        }
        echo json_encode(array('error' => $error, 'mensaje' => $mensaje));
    }

    public function profile()
    {
        $id_user = Auth::user()->id;
        $user = User::find($id_user);
        return view('admin.profile', compact('user'));
    }
}
