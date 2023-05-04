<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ImageService{

    public function validate($request){
        $rules = [
            'image' => 'file|image|max:20048',
        ];

        $messages = [
            'image.file' => 'Не похоже на файл, попробуйте еще',
            'image.image' => 'Не похоже на картинку, попробуйте еще',
            'image.max' => 'Аватарка слишком много весит, попробуйте загрузить другую',
        ];

        $request->validate($rules, $messages);
        return true;
    }

    public function delete(User $user){
        if (isset($user->avatar)){
            Storage::delete($user->avatar);
        }
    }

    public function update(User $user, $image){
        $filename = $image->store('/uploads');
        $user->update([
            'avatar'=>"/".$filename,
        ]);
    }

}
