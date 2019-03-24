<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\PetsModel;

class CommonController extends Controller
{
    public function hungry(Request $request)
    {
        $id_pet = $request->id;

    }

    public function sleep(Request $request)
    {

    }

    public function care(Request $request)
    {

    }

    public function fun(Request $request)
    {

    }

    public function addPet(Request $request)
    {
        //TODO: answers
        if (Auth::check()) {
            $pet = isset($request->pet) ? $request->pet : null;

            if ($pet != null) {
                $id_user = Auth::id();
                $check_user_pet = PetsModel::where('pet_type', $pet)->where('id_user', $id_user)->count();
                if ($check_user_pet == 0) {
                    $pets = new  PetsModel();
                    $pets->id_user = $id_user;
                    $pets->pet_type = $pet;
                    $pets->save();
                } else {
                    echo 'always_present';
                }
            } else {
                echo 'empty_value';
            }

        } else {
            echo "auth_error";
        }
    }

    public function ListPets()
    {
        $pets = [];
        if (Auth::check()) {
            $id_user = Auth::id();
            $pets = PetsModel::where('id_user', $id_user)->get();
        }
        return $pets;
    }
}
