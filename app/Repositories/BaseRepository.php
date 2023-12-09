<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Log;

class BaseRepository
{
    protected $model, $relations;

    public function __construct(Model $model, array $relations = []) {
        $this->model = $model;
        $this->relations = $relations;
    }

    /**
     *
     * saca todos los registros
     */
    public function all() {
        return $this->model->whereHas($this->relations)
        ->with($this->relations)
        ->get();
    }

    /**
     *
     * lista un registro en especifico
     * @param Model $model
     */
    public function get(Model $model) {
        return $model;
    }

    /**
     *
     * crea un registro en el modelo
     * @param Model $model
     */
    public function save(Model $model) {
        $model->save();
        return $model;
    }


    /**
     *
     * crea un registro en el modelo
     * @param Array $attributes
     */
    public function create(array $attributes) {
        $newObj = $this->model->create($attributes);
        return $newObj;
    }


    /**
     *
     * borramos un registro
     * @param Model $model
     */
    public function delete(Model $model) {
        $model->delete();
        return $model;
    }


}
