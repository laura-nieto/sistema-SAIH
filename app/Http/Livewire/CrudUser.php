<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Empresa;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Auth;

class CrudUser extends Component
{
    public $nombre,$apellido,$email,$password,$id_user,$id_empresa,$sucursales_id=[];
    public $modal = false;
    public $search;
    public $roles,$role_id;
    public $sucurales,$empresas,$empresa_id;

    protected $messages = [
        'required' => 'El campo es requerido.',
        'email' => 'La dirección de Email debe tener un formato adecuado.',
        'unique' => 'Ya existe un registro con ese Email.',
        'min' => 'El campo debe tener al menos :min caracteres',
    ];

    public function mount()
    {
        $this->sucursales = Sucursal::all();
    }
    public function render()
    {
        if (auth()->user()->hasRole(1)) {
            $users = User::where('nombre','like','%'.$this->search.'%')
                    ->orWhere('apellido','like','%'.$this->search.'%')
                    ->get();
        } else {
            $users = User::where('empresa_id',auth()->user()->empresa_id)
            ->where( function($query) {
                $query->where('nombre','like','%'.$this->search.'%');
                $query->orWhere('apellido','like','%'.$this->search.'%');
            })
        ->get();
        }

        return view('livewire.users.crud-user',compact('users'));
    }
    public function crear()
    {
        $this->roles = Role::all();
        if (auth()->user()->hasRole(1)) {
            $this->empresas = Empresa::all();
        }else{
            $this->empresas = auth()->user()->empresa;
        }
        $this->limpiarCampos();
        $this->abrirModal();
    }
    public function editar($id)
    {
        $this->roles = Role::all();
        if (auth()->user()->hasRole(1)) {
            $this->empresas = Empresa::all();
        }else{
            $this->empresas = auth()->user()->empresa;
        }
        $user = User::findOrFail($id);
        $this->id_user = $user->id;
        $this->nombre = $user->nombre;
        $this->apellido = $user->apellido;
        $this->email = $user->email;
        $this->sucursales_id = $user->sucursales->pluck('id');
        $this->role_id = $user->roles->first()->id;
        $this->abrirModal();
    }
    public function save()
    {
        $rules = [
            'nombre' => 'required|min:2',
            'apellido' => 'required|min:2',
            'email' => 'required|email|unique:users,email,'.$this->id_user,
            'password' => 'required|min:6',
        ];
        $this->validate($rules);
        $user = User::updateOrCreate(['id'=>$this->id_user],
        [
            'nombre'=>$this->nombre,
            'apellido'=>$this->apellido,
            'email'=>$this->email,
            'password'=>Hash::make($this->password),
            'empresa_id'=>$this->empresa_id == '' ? null : $this->empresa_id,
        ]);
        $user->roles()->sync([$this->role_id]);
        $user->sucursales()->sync($this->sucursales_id);
        Bitacora::create([
            'seccion' => 'Usuarios',
            'descripcion' => 'Creación o Modificación',
            'usuario_id' => Auth::id(),
        ]);
        $this->cerrarModal();
        $this->limpiarCampos();
    }
    public function borrar($id)
    {
        User::findOrFail($id)->delete();
        Bitacora::create([
            'seccion' => 'Usuarios',
            'descripcion' => 'Borrado',
            'usuario_id' => Auth::id(),
        ]);
    }


    //FUNCIONES MODAL
    public function abrirModal()
    {
        $this->modal = true;
    }
    public function cerrarModal()
    {
        $this->modal = false;
    }
    public function limpiarCampos()
    {
        $this->nombre = NULL;
        $this->id_user = NULL;
        $this->id_empresa = NULL;
        $this->apellido = NULL;
        $this->email = NULL;
        $this->password = NULL;
        $this->sucursales_id = [];
    }
}
