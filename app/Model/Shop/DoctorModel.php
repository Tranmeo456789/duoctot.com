<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;
use App\Model\Shop\CollaboratorsClinicDoctor;

class DoctorModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'doctor';
    }
    public function listItems($params = null, $options = null){
        $result = [];
        if ($options['task'] == 'list-items-for-search'){
            $query = self::select('doctor.doctor_id as id','doctor.doctor_name as name','doctor.profile_image','doctor.doctor_address as address','doctor.price','doctor.created_at');
            if (isset($params['province']) && $params['province'] != ''){
                $query->where('province_id', $params['province']);
            }
            if (isset($params['speciality']) && $params['speciality'] != ''){
                $query->whereIn('doctor_id', function ($query) use ($params){
                    $query->select("doctor_speciality.doctor_id")
                            ->from("speciality")
                            ->leftjoin("doctor_speciality","speciality.speciality_id","=","doctor_speciality.speciality_id")
                            ->where("speciality.specialty_url",$params['speciality']);
                });
            }
            if (isset($params['user'])){
                $user = json_decode(json_encode($params['user']));
                $refer_id = $params['user']->refer_id ;
                $collaborator = CollaboratorsUserModel::where('code',$refer_id)->first();

                if ($collaborator)  { //Nếu refer_id là của bác sĩ
                    $collaborator_code = $collaborator->code;

                    $arrDoctocID = CollaboratorsClinicDoctor::select("doctor_id")
                                                    ->where("collaborators_clinic_doctor.collaborator_code",$collaborator_code)
                                                    ->first();
                    if (!empty($arrDoctocID)) {
                        $query->whereIn('doctor_id',$arrDoctocID->doctor_id);
                    }
                }else{
                    $prefix = substr($params['user']->refer_id,0,2);
                    if (($prefix == 'BS') || ($prefix == 'bs')) { //Nếu refer_id là của bác sĩ
                        $doctorID = substr($params['user']->refer_id ,2);
                        $query->where('doctor_id',$doctorID);
                    }
                }
            }
            $result = $query->where('status',1)
                            ->orderBy("$this->table.doctor_id", 'desc')
                            ->paginate($params['limit']);
        }
        return $result;
    }
    public function specialities(){
    	return $this->hasMany('\App\DoctorSpeciality','doctor_id');
    }
    public function clinics(){
    	return $this->hasMany('\App\DoctorClinic','doctor_id');
    }
    public function services(){
    	return $this->hasMany('\App\DoctorService','doctor_id');
    }

    public function language(){
    	return $this->hasMany('\App\DoctorLanguage','doctor_id');
    }
    // public function rating(){
    // 	return $this->hasMany('\App\Comment','doctor_id')->select('comment_id');
    // }
    public function user(){
    	return $this->hasOne('\App\Users','user_id','user_id')->select('user_id' ,'avatar');
    }
    public function comment(){
    	return $this->hasMany('\App\Comment','doctor_id')
                    ->orderBy('created_at', 'DESC');
    }
    public function notify(){
    	return $this->hasMany('\App\Notify','doctor_id')->orderBy('created_at', 'DESC');
    }
    public function clinicalAchievements(){
        return $this->hasMany('\App\ClinicalAchievements','doctor_id')
                    ->orderBy('clinical_achievements_id', 'DESC')
                    ->take(5);
    }
}

