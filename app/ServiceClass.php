<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 3/25/2019
 * Time: 7:14 AM
 */

namespace App;
use App\Events\UpdatePets;


class ServiceClass
{
    public function eventUpdate()
    {
        $users = User::all();
        foreach ($users as $user) {
            $pets = PetsModel::select(['id', 'pet_type', 'hunger', 'sleep', 'care'])->where('id_user', $user->id)->get();
            event(new UpdatePets($pets->toJson(JSON_PRETTY_PRINT), $user->id));
        }
    }
}
