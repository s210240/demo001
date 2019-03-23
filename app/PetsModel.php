<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    id
 * @property int    id_user
 * @property string pet_type
 * @property int    hunger
 * @property int    sleep
 * @property int    care
 * @property string hunger_time
 * @property string sleep_time
 * @property string care_time
 */
class PetsModel extends Model
{
    protected $table = 'pets';

    public $timestamps = false;
}
