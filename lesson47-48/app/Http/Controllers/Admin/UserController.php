<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {

        $users = User::where('id', '!=', auth()->id())
            ->orderBy('is_admin', 'desc')
            ->get();

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function toggle(Request $request, User $user)
    {

        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Вы не можете изменить свои собственные права администратора');
        }

        try {

            $user->update([
                'is_admin' => !$user->is_admin
            ]);


            $statusMessage = $user->is_admin
                ? "Пользователь {$user->name} назначен администратором"
                : "Пользователь {$user->name} лишен прав администратора";

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Статус изменен',
                    'is_admin' => $user->is_admin
                ]);
            }

            return redirect()->route('admin.users.index')
                ->with('success', $statusMessage);

        }catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ошибка'
                ]);
            }
            return redirect()->route('admin.users.index')
                ->with('error', 'Произошла ошибка при изменении прав. Пожалуйста, попробуйте позже.');
        }


    }
}
