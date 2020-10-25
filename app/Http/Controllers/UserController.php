<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LibUser;
use App\User;
use App\Comentario;
use Barryvdh\DomPDF\Facade as PDF;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Gate::allows('isAdmin')){
            $users = User::paginate(12);
        }else {
            $users = User::where('role_id',null)->paginate(12);
        }
        $visible=false;

        return view('users.index',compact(['users','visible']));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $visible = false;
        $user->with(['comentarios','libros']);

        //return $user->role_id;
        return view('users.show', compact(['user','visible']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.index');
    }

    /*
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comentario::commentsUser($id)->delete();
        Comentario::where('user_id',$id)->delete();
        User::findOrFail($id)->delete();

        return $this->index();
    }

    public function eliminar($id){
        LibUser::where('user_id',$id)->delete();
        Comentario::commentsUser($id)->forceDelete();
        Comentario::onlyTrashed()->where('user_id',$id)->forceDelete();
        User::onlyTrashed()->where('id',$id)->forceDelete();

        return redirect()->route('users.indexElim')
        ->with([
            'alerta' => 'Usuario eliminado permanentemente',
            'clase-alerta' => 'alert-danger'
            ]);
    }

    public function restaurar($id){
        Comentario::commentsUser($id)->restore();
        Comentario::onlyTrashed()->where('user_id',$id)->restore();
        User::onlyTrashed()->where('id',$id)->restore();

        return redirect()->route('users.indexElim')
        ->with([
            'alerta' => 'Usuario restaurado con éxito',
            'clase-alerta' => 'alert-success'
            ]);
    }

    public function showElim($id)
    {
        $user = User::onlyTrashed()->with(['comentarios','libros'])->firstWhere('id',$id);
        $visible = true;
        return view('users.show',compact(['user','visible']));
    }

    public function indexElim(){
        $users = User::onlyTrashed()->paginate(12);
        $visible = true;
        return view('users.index', compact(['users','visible']));
    }

    public function imprimirUser($id){

        $users = User::findOrFail($id);
        $pdf = \PDF::loadView('users.pdf', compact('users'));
        return $pdf->download('Datos.pdf');
    }

}
