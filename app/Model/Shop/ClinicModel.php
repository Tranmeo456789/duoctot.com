<?php

namespace App\Model\Shop;

use App\Model\Shop\BackEndModel;
use DB;

class ClinicModel extends BackEndModel
{
    protected $connection = 'mysql_share_data';
    protected $primaryKey = "clinic_id";
    public function __construct() {
        $this->table               = 'clinic';
    }

    public function listItems($params = null, $options = null){
        $result = [];

        if ($options['task'] == 'list-items-for-search'){
            $query = self::select('clinic.clinic_id as id','clinic.clinic_name as name','clinic.profile_image','clinic.clinic_address as address','clinic.price','clinic.created_at');
            if (isset($params['province']) && $params['province'] != ''){
                $query->where('province_id', $params['province']);
            }
            if (isset($params['speciality']) && $params['speciality'] != ''){
                $query->whereIn('clinic_id', function ($query) use ($params){
                    $query->select("clinic_speciality.clinic_id")
                            ->from("speciality")
                            ->leftjoin("clinic_speciality","speciality.speciality_id","=","clinic_speciality.speciality_id")
                            ->where("speciality.specialty_url",$params['speciality']);
                });
            }
            if (isset($params['user'])){
                $user = json_decode(json_encode($params['user']));
                $refer_id = $params['user']->refer_id ;
               // $collaborator = CollaboratorsUser::where('code',$refer_id)->first();

                // if ($collaborator)  { //Nếu refer_id là của bác sĩ
                //     $collaborator_code = $collaborator->code;
                //     $arrClinicID = \App\CollaboratorsClinicDoctor::select("clinic_id")
                //                     ->select('clinic_id')
                //                     ->where("collaborators_clinic_doctor.collaborator_code",$collaborator_code)
                //                     ->first();

                //     if (!empty($arrClinicID)) {
                //         $query->whereIn('clinic_id',$arrClinicID->clinic_id);
                //     }
                // }else{
                    $prefix = substr($params['user']->refer_id,0,2);
                    if (($prefix == 'PK') || ($prefix == 'pk')){ //Nếu refer_id là của bác sĩ
                        $clinic_id = substr($params['user']->refer_id ,2);
                        $query->where('clinic_id',$clinic_id);
                    }
               // }
            }
            $result = $query->orderBy("$this->table.clinic_id", 'desc')
                            ->paginate($params['limit']);
        }
        return $result;
    }

}

