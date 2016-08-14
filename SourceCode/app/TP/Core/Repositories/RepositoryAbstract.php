<?php

/**
 * Created by PhpStorm.
 * Users: phamt
 * Date: 8/7/2016
 * Time: 10:22 AM
 */
namespace App\TP\Core\Repositories;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use stdClass;

abstract class RepositoryAbstract implements RepositoryInterface
{
    protected $model;

    /**
     * Get empty model.
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get table name.
     *
     * @return string
     */
    public function getTable()
    {
        return $this->model->getTable();
    }

    /**
     * Make a new instance of the entity to query on.
     *
     * @param array $with
     */
    public function make(array $with = [])
    {
        return $this->model->with($with);
    }

    /**
     * Retrieve model by id
     * regardless of status.
     *
     * @param int $id model ID
     *
     * @param array $with
     * @param array $columns
     * @return Model
     */
    public function byId($id, array $with = [], $columns = ['*'])
    {
        $query = $this->make($with)->where('id', $id);
        $model = $query->firstOrFail($columns);
        return $model;
    }

    /**
     * Get all models.
     *
     * @param array $with Eager load related models
     * @param array $columns
     * @return NestedCollection|Collection
     * @internal param bool $all Show published or all
     *
     */
    public function all(array $with = [], $columns = ['*'])
    {
        $query = $this->make($with);

        // Get
        return $query->get($columns);
    }

    /**
     * Get paginated models.
     *
     * @param int   $page  Number of models per page
     * @param int   $limit Results per page
     * @param bool  $all   get published models or all
     * @param array $with  Eager load related models
     *
     * @return stdClass Object with $items && $totalItems for pagination
     */
    public function byPage($page = 1, $limit = 10, array $with = [])
    {
        $result = new stdClass();
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = [];

        $query = $this->make($with);



        $totalItems = $query->count();

        $query->order()
            ->skip($limit * ($page - 1))
            ->take($limit);

        $models = $query->get();

        // Put items and totalItems in stdClass
        $result->totalItems = $totalItems;
        $result->items = $models->all();

        return $result;
    }

}