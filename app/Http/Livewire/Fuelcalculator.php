<?php

namespace App\Http\Livewire;

use App\Helpers\Helper;
use App\Models\Brands;
use App\Models\Cars;
use Livewire\Component;

class Fuelcalculator extends Component
{

    public $fuelavg = null;
    public $fuelprice = null;
    public $fuelrange = null;
    public  $calculated = null;
    public  $calcrange = null;
    public  $calcrangeh = null;
    public  $fueledrange = null;
    public  $istanbulbenzin = null;
    public  $istanbuldizel= null;



    public function render()
    {
        return view('livewire.fuelcalculator');
    }
    public function mount()
    {

        $information = Helper::getfuelprice();
        $this->istanbulbenzin = $information['istanbulbenzin'];
        $this->istanbuldizel = $information['istanbuldizel'];

    }
    public function updatedfuelavg($fuelavg) {
        $this->fuelavg = $fuelavg ;
    }
    public  function updatedfuelprice($fuelprice) {
        if($fuelprice == 'Benzin') {
            $this->fuelprice = $this->istanbulbenzin;
        }
        elseif($fuelprice == 'Dizel') {
            $this->fuelprice = $this->istanbuldizel;
        };

    }
    public  function updatedfuelrange($fuelrange) {
        $this->fuelrange = $fuelrange;
        $this->fueledrange = $fuelrange;
    }

    public function calculate() {
        $this->calculated = ($this->fuelavg*$this->fuelprice)/100;
        $this->calcrange = (($this->calculated*$this->fuelrange)*10)/10;
        $this->calcrangeh = (($this->calculated*100)*10)/10;
    }
}
