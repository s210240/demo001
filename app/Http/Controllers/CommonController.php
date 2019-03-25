<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\PetsModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CommonController extends Controller
{

    public function updatePet(Request $request)
    {
        if (Auth::check()) {
            try {
                $id_pet = $request->id_pet;
                $pet_action = $request->pet_action;

                switch ($pet_action) {
                    case 1: // hunger
                        $check = DB::select('SELECT COUNT(*) AS result FROM pets WHERE id = ? AND `hunger_time` <  (now()- interval 5 minute)', [$id_pet]);
                        if ($check[0]->result == 0) {
                            PetsModel::where('id', $id_pet)
                                ->update([
                                    'hunger' => DB::raw('hunger+1'),
                                    'hunger_time' => Carbon::now()
                                ]);
                        }
                        break;
                    case 2: // sleep
                        $check = DB::select('SELECT COUNT(*) AS result FROM pets WHERE id = ? AND `sleep_time` <  (now()- interval 10 minute)', [$id_pet]);
                        if ($check[0]->result == 0) {
                            PetsModel::where('id', $id_pet)
                                ->update([
                                    'sleep' => DB::raw('sleep+1'),
                                    'sleep_time' => Carbon::now()
                                ]);
                        }
                        break;
                    case 3: //care
                        $check = DB::select('SELECT COUNT(*) AS result FROM pets WHERE id = ? AND `care_time` <  (now()- interval 5 minute)', [$id_pet]);
                        if ($check[0]->result == 0) {
                            PetsModel::where('id', $id_pet)
                                ->update([
                                    'care' => DB::raw('care+1'),
                                    'care_time' => Carbon::now()
                                ]);
                        }
                        break;
                    default:
                        break;
                }

            } catch (\Exception $e) {
                Log::error('Pets update error');
            }
        } else {
            echo "auth_error";
        }
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
