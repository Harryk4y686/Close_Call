<?php

use Illuminate\Support\Facades\Route;

Route::get('/check-users', function() {
    $users = \App\Models\User::all()->map(function($u) {
        return [
            'table' => 'users',
            'id' => $u->id,
            'email' => $u->email,
            'name' => $u->name,
            'first_name' => $u->first_name ?? null,
            'is_admin' => $u->is_admin ?? false,
            'verified' => $u->verified ?? false
        ];
    });
    
    $pengguna = \App\Models\Pengguna::all()->map(function($p) {
        return [
            'table' => 'pengguna',
            'id' => $p->id,
            'email' => $p->email,
            'first_name' => $p->first_name ?? null,
            'last_name' => $p->last_name ?? null,
            'verified' => $p->verified ?? false
        ];
    });
    
    return response()->json([
        'users_table' => $users,
        'pengguna_table' => $pengguna,
        'looking_for' => 'saverogrant@gmail.com'
    ], 200, [], JSON_PRETTY_PRINT);
});
