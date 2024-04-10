<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\User;




class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $usuarios = User::all();
        
            return view('profile.index', compact('usuarios'));

        }
        return redirect()->route('welcome');
    }
    /**
     * Display the user's profile form.
     */

     public function register(): View
     {
         return view('auth.register', [
            
         ]);
     }

    public function store(Request $request)
    {
        $user=User::where('name', $request->name)->first();
        $admin = 0;
        $super = 0;
        // Si existe
        if(!$user){
            if( $request->tipo == 0){
                $admin = 0;
                $super = 0;
            }
            if( $request->tipo == 1){
                $admin = 1;
                $super = 0;
            }
            if( $request->tipo == 2){
                $admin = 0;
                $super = 1;
            }
                    $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'super' => $super,
                        'admin' => $admin, 
                        'password' => $request->password,
                    ]);
          return redirect()->route('profile.index')
            ->with('mensaje','Usuario creado correctamente.');
        } else{
           
         
          return redirect()->route('home')
            ->with('mensaje','Ya existe un usuario con ese nombre.');
        }
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function eliminar(Request $request)
    {
        if (Auth::check()) {
        $usuario = User::where('id', $request->idusuario);
        $usuario->delete();

        return redirect()->route('profile.index')
            ->with('mensaje', 'Usuario eliminado correctamente');
        }
        return redirect()->route('welcome');
    }

}
