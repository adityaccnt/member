<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserHobby;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        // get list user
        $users  = collect(User::all());
        $data = array();

        // get userHobby by user
        foreach ($users as $user) {
            $tmp = array();
            foreach ($user->userHobby as $val_users) {
                $UserHobby  = UserHobby::find($val_users->id);
                array_push($tmp, $UserHobby->hobby);
            }
            $tmp2 = collect($user)->merge(['hobby' => $tmp]);
            array_push($data, $tmp2);
        }

        // success output
        return response()->json([
            'status'    => true,
            'message'   => 'Data ditampilkan',
            'data'      => $data
        ]);
    }

    public function store(Request $request)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|min:2|max:50',
            'email'     => 'required|email:dns|unique:users',
            'phone'     => 'required|starts_with:0|digits_between:7,14',
            'hobby_id'  => 'required|array|exists:Hobbies,id'
        ]);

        // failed output
        if ($validator->fails())
            return response()->json([
                'status'    => false,
                'message'   => 'Data gagal disimpan',
                'data'      => $validator->errors()
            ], 400);

        // get user id
        $id = User::create($request->all())->id;

        // insert Hobby to UserHobby
        foreach ($request->hobby_id as $value)
            UserHobby::create([
                'user_id'   => $id,
                'hobby_id'  => $value
            ]);

        // add id to output
        $data = collect($request->all())->merge(['id' => $id])->sort();

        // success output
        return response()->json([
            'status'    => true,
            'message'   => 'Data disimpan',
            'data'      => $data
        ]);
    }

    public function show(User $user)
    {
        // get data selected
        $users  = collect(User::find($user->id));
        $result = array();

        // push userHobby to $result
        foreach ($user->userHobby as $val_users) {
            $UserHobby  = UserHobby::find($val_users->id);
            array_push($result, $UserHobby->hobby);
        }

        // add $result to output
        $data = $users->merge(['hobby' => $result]);

        // success output
        return response()->json([
            'status'    => true,
            'message'   => 'Data ditampilkan',
            'data'      => $data
        ]);
    }

    public function update(Request $request, User $user)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|min:2|max:50',
            'email'     => 'required|email:dns|unique:users',
            'phone'     => 'required|starts_with:0|digits_between:7,14',
            'hobby_id'  => 'required|array|exists:Hobbies,id'
        ]);

        // failed output
        if ($validator->fails())
            return response()->json([
                'status'    => false,
                'message'   => 'Data gagal diperbarui',
                'data'      => $validator->errors()
            ], 400);

        // get user id
        User::find($user->id)->update($request->except(['hobby_id']));

        // select and delete from user selected
        UserHobby::where('user_id', $user->id)->delete();

        // insert Hobby to UserHobby
        foreach ($request->hobby_id as $value)
            UserHobby::create([
                'user_id'   => $user->id,
                'hobby_id'  => $value
            ]);

        // add id to output
        $data = collect($request->all())->merge(['id' => $user->id])->sort();

        // success output
        return response()->json([
            'status'    => true,
            'message'   => 'Data diperbarui',
            'data'      => $data
        ]);
    }

    public function destroy(User $user)
    {
        // select and delete from user selected
        User::find($user->id)->delete();
        UserHobby::where('user_id', $user->id)->delete();

        // success output
        return response()->json([
            'status'    => true,
            'message'   => 'Berhasil dihapus',
            'data'      => null
        ], 200);
    }

    public function token()
    {
        return response()->json([
            'status'    => true,
            'message'   => 'Token berhasil digenerate',
            'data'      => $this->encoder('UNIKTIF_MEDIA_INDONESIA')
        ]);
    }

    public function encoder($data)
    {
        $secret = env('APP_KEY');
        $payload = [
            'iss' => "UNIKTIF",
            'sub' => $data,
            'iat' => time(),
            'exp' => time() + 60 * 60 * 24
        ];
        $encPayload = JWT::encode($payload, $secret, 'HS256');
        return $encPayload;
    }

    public function decoder($token)
    {
        $payload = JWT::decode($token, new Key(env('APP_KEY'), 'HS256'));
        $jsn = $payload->sub;
        return $jsn;
    }
}
