<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class DoctorServiceModel extends Model
{
      protected $table = "doctor_service";
    protected $primaryKey = "doctor_service_id";
    public function service(){
    	return $this->hasOne('\App\Service','service_id','service_id');
    }
}
