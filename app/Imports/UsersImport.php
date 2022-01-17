<?php

namespace App\Imports;

use App\Models\User;
use App\Providers\FortifyServiceProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Http\Request;

class UsersImport implements ToCollection
{
    use Importable;

    public function __construct()
    {

    }

    public function collection(Collection $collection)
    {
        Validator::make($collection->toArray(),[
            '*.0' => 'required|max:255',
            '*.1' => 'required|max:255',
            '*.2' => 'required|email|max:255|unique:users,email',
        ])->validate();

        foreach ($collection as $row) {
            $password = bcrypt(Str::random(35));

            $user_data = User::create([
                'name' => $row[0],
                'last_name' => $row[1],
                'email' => $row[2],
                'email_verified_at' => now(),
                'password' => Hash::make('asdasdasd'),
                'type' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            Password::sendResetLink($user_data->only(['email']));
        }

        return redirect('/administrador/usuarios')->with('message', 'Usuarios añadidos correctamente');
    }
}
