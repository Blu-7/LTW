<?php

namespace App\Http\Services\User;

use App\User;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper;
class UserService
{
    public function getUser($request)
    {
        $result = User::where('email', $request->input('email'))->first();
        return $result;
    }

    public function getAll()
    {
        return User::with('role')->orderBy('id')->search()->paginate(10);
    }

    public function createAvatar($char) {
        $path = 'storage/uploads/users/';
        $fontPath = public_path('fonts/Roboto-Bold.ttf');
        $char = strtoupper($char);
        $newAvatarName = "UIMG" . date('Ymd') . uniqid() . '.png';
        $dest = $path . $newAvatarName;
        $createAvatar = \App\Helpers\Helper::makeAvatar($fontPath, $dest, $char);
        return $createAvatar;
    }
    public function create($request) {
        if (!$request->input('image')) {
            $char = $request->input('name')[0];
            $image = $this->createAvatar($char);
        } else {
            $image = $request->input('image');
        }
        try {
            User::create([
                'name' => (string) $request->input('name'),
                'phone' => (string) $request->input('phone'),
                'image' => (string) $image,
                'email' => (string) $request->input('email'),
                'password' => (string) bcrypt($request->input('password')),
                'role_id' => (int) $request->input('role_id'),
            ]);
            return true;
        } catch (\Exception $err) {
            return false;
        }
    }

    public function update($user, $request)
    {
        $request->except("_token");
        try {
            $user->fill($request->input());
            $user->save();

            return true;
        } catch (\Exception $err) {
            return false;
        }
    }

    public function destroy($request)
    {
        $user = User::find($request->input('id'));
        if ($user) {
            try {
                $path = str_replace('storage', 'public', $user->image);
                Storage::delete($path);
                return $user->delete();
            } catch (\Exception $err) {
                return false;
            }
        }
        return false;
    }

    public function destroySelected($request)
    {
        $ids =  explode(',', $request->ids);
        $users = User::whereIn('id', $ids)->get();
        $length = count($users);

        if ($users) {
            try {
                for($i = 0; $i < $length; $i++) {
                    $path = str_replace('storage', 'public', $users[$i]->image);
                    Storage::delete($path);
                    $users[$i]->delete();
                }
                return true;
            } catch (\Exception $err) {
                return false;
            }
        }
        return false;
    }
}
