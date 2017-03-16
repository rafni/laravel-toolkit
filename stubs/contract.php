<?php

namespace App\Repositories\ReplaceModule;

use App\Repositories\ReplaceModule\ReplaceModel;

/**
 * Class ReplaceContract
 * @package App\Repositories\ReplaceModule
 */
interface ReplaceContract
{
    /**
     * @param int $limit
     * @return mixed
     */
    public function get($limit = 10);

    /**
     * @param int|string $id
     * @return ReplaceModel
     */
    public function find($id);

    /**
     * @param array $attributes
     * @return ReplaceModel
     */
    public function create(array $attributes = []);

    /**
     * @param int|string $id
     * @param array $attributes
     * @return ReplaceModel
     */
    public function update($id, array $attributes = []);

    /**
     * @param int|string $id
     * @return bool
     */
    public function delete($id);
}