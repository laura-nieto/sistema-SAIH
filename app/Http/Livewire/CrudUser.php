<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Empresa;

class CrudUser extends Component
{
    public $nombre,$apellido,$email,$password,$id_user,$id_empresa;
    public $modal = false;
    //public $modalDelete = false;
    public $search;
    public $roles,$role_id;
    public $empresas,$empresa_id;

    protected $rules = [
        'nombre' => 'required|min:2',
        'apellido' => 'required|min:2',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ];
    protected $messages = [
        'required' => 'El campo es requerido.',
        'email' => 'La dirección de Email debe tener un formato adecuado.',
        'unique' => 'Ya existe un registro con ese Email.',
        'min' => 'El campo debe tener al menos :min caracteres',
    ];

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
        $user = User::findOrFail($id);
        $this->id_user = $user->id;
        $this->nombre = $user->nombre;
        $this->apellido = $user->apellido;
        $this->email = $user->email;
        $this->abrirModal();
    }
    public function save()
    {
        $this->validate();
        $user = User::updateOrCreate(['id'=>$this->id_user],
        [
            'nombre'=>$this->nombre,
            'apellido'=>$this->apellido,
            'email'=>$this->email,
            'password'=>Hash::make($this->password),
            'empresa_id'=>$this->empresa_id == '' ? null : $this->empresa_id,
        ]);
        $user->roles()->sync([$this->role_id]);
        $this->cerrarModal();
        $this->limpiarCampos();
    }
    public function borrar($id)
    {
        User::findOrFail($id)->delete();
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
        $this->nombre = '';
        $this->apellido = '';
        $this->email = '';
        $this->password = '';
    }
}
