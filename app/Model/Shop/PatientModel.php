<?php

namespace App\Model\Shop;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\ConfigModel;
use App\Model\Shop\RechargeModel;

class PatientModel extends Model
{
    protected $defaults = array(
        'balance' => 4000,
    );

    public function __construct(array $attributes = array())
    {
        $this->setRawAttributes($this->defaults, true);
        parent::__construct($attributes);
    }

    protected $table = "patient";
    protected $primaryKey = "patient_id";

    public function minusTime($timeCall){
        $unit           = ConfigModel::where('id', 2)->first();
        $unit           = (!empty($unit))? intval($unit->content) : 1000;
        $this->balance  -= CEIL($timeCall*$unit);
    }

    public function minusTimeV2($unit, $timeCall){
        $unit           = (!empty($unit))? intval($unit) : 1000;
        $this->balance  -= CEIL($timeCall*$unit);
    }

    public function minusTimeMessage($timeCall){
        $unit           = ConfigModel::where('id', 3)->first();
        $unit           = (!empty($unit))? intval($unit->content) : 1000;
        $this->balance  -= CEIL($timeCall*$unit);
    }

    public function minusTimeMessageWithUnit($timeCall, $unitPrice){
        $unit           = ConfigModel::where('id', 3)->first();
        if ($unitPrice === null) {
            $unitPrice           = intval($unit->content);
        }

        $this->balance  -= CEIL($timeCall*$unitPrice);
    }

    public function createRecharge($quantity){
        $recharge = new RechargeModel();
        $recharge->patient_id = $this->patient_id;
        $recharge->quantity = $quantity;
        $recharge->save();
    }

    public function recharges(){
        $items = RechargeModel::where('patient_id', $this->patient_id)->orderBy('recharge_id', 'desc')->paginate(10);
        return $items;
    }
}
