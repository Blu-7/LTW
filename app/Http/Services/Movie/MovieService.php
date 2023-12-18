<?php

namespace App\Http\Services\Movie;

use App\Movie;

class MovieService
{
    public function create($request){
        try {
            Movie::create([
               'name' => (string) $request->input('name'),
            ]);
        }catch (\Exception $err){

        }
    }

}
