<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class CollaboratorsClinicDoctor extends Model
{
    protected $connection = 'mysql_share_data';
    protected $table = 'collaborators_clinic_doctor';
    protected $primaryKey = "collaborator_code";
    public $timestamps = false;
    protected $casts = [
        'doctor_id'   => 'array',
        'clinic_id' => 'array',
        'user_id' => 'array',
    ];
}
