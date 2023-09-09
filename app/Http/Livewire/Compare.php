<?php

namespace App\Http\Livewire;

use App\Models\Brands;
use App\Models\Cars;
use App\Models\CompareList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Compare extends Component
{

    public $selectedbrand = null;
    public $models = null;
    public $selectedmodel = null;
    public $specs = null;
    public $selectedspec = null;
    public $result = null;
    public  $check= null;
    public $datas = [];

public $model_name= null;
public $model_id = null;


 public $allresult=[];

public function mount() {



}

public function updatedSelectedbrand($brand_name) {
        $this->models = Cars::select('model_id', 'model_name')
            ->where('brand_name', $brand_name)
            ->groupBy('model_name')
            ->get();
    $this->specs = null;
    $this->result = null;
    $this->model_name= null;
    $this->model_id= null;

}
public  function updatedselectedmodel($model_name) {
        $this->specs = Cars::where('model_name',$model_name)->WhereNotIn('model_id', $this->allresult)->get();

        $this->model_name = null;
        $this->model_id= null;




}

public  function updatedselectedspec($model_id) {

        $this->result = $model_id;
    $this->model_id= null;



}

    public function render()
    {


        if (count($this->datas) < count($this->allresult)){
           $this->datas = Cars::whereIn('model_id', $this->allresult)->get();
       }

       // $this->datapre = Cars::where('model_id', $this->result)->get();

        $brands = Cache::remember('comparebrands', 30000 ,function () {
            return    Brands::withCount('cars')->get();
        });

        return view('livewire.compare', compact('brands'));


}
    public function addSelect() {
        return redirect()->to(route('selectresult', ['ids' => implode('-', $this->allresult)]));
    }
    public function addModel() {
        $this->allresult[]=$this->result;
        if (count($this->allresult) > 1) {
            $this->check = $this->result;
        }
        $this->models = null;
        $this->specs = null;
        $this->result = null;
$this->selectedbrand = null;
$this->selectedmodel = null;
$this->selectedspec = null;
        $this->model_name= null;
        $this->model_id= null;



    }
}
