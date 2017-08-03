<?php

namespace App\ModulesDirectory\ReplaceModule;

use Rafni\LaravelToolkit\Traits\ValidateAbleTrait as ValidateAble;
use App\ModulesDirectory\ReplaceModule\ReplaceModel;
use App\ModulesDirectory\ReplaceModule\ReplaceContract;

/**
 * Class ReplaceService
 * @package App\ModulesDirectory\ReplaceModule
 */
class ReplaceService implements ReplaceContract
{
    use ValidateAble;
    
    /**
     * @var array
     */
    protected $validationCreateRules = [

    ];

    /**
     * @var array
     */
    protected $validationUpdateRules = [

    ];

    /**
     * @var array
     */
    protected $validationMessages = [

    ];

    /**
     * @var ReplaceModel
     */
    protected $model;

    /**
     * @var array
     */
    protected $includes = [];

    /**
     * ReplaceService constructor.
     * @param ReplaceModel $model
     */
    public function __construct(ReplaceModel $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $limit
     * @return mixed
     */
    public function get($limit = 10)
    {
        $model = $this->model->with($this->includes);
        if (!empty($limit)) {
            return $model->paginate($limit);
        }
        return $model->get();
    }

    /**
     * @param int|string $id
     * @return ReplaceModel
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $attributes
     * @return ReplaceModel
     * @throws ValidationException
     */
    public function create(array $attributes = [])
    {
        $this->runValidator($attributes, $this->validationCreateRules, $this->validationMessages);
        $model = $this->model->create($attributes);
        return $model;
    }

    /**
     * @param int|string $id
     * @param array $attributes
     * @return ReplaceModel
     * @throws ValidationException
     */
    public function update($id, array $attributes = [])
    {
        $model = $this->find($id);
        $this->runValidator($attributes, $this->validationUpdateRules, $this->validationMessages);
        $model->fill($attributes);
        $model->save();
        return $model->fresh();
    }

    /**
     * @param int|string $id
     * @return bool
     */
    public function delete($id)
    {
        $model = $this->find($id);
        return $model->delete();
    }
}