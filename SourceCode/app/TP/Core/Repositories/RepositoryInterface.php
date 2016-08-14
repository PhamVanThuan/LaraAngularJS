<?php

/**
 * Created by PhpStorm.
 * Users: phamt
 * Date: 8/7/2016
 * Time: 10:22 AM
 */
namespace App\TP\Core\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

interface RepositoryInterface
{
    /**
     * Get empty model.
     *
     * @return Model
     */
    public function getModel();

    /**
     * Get table name.
     *
     * @return string
     */
    public function getTable();

    /**
     * Make a new instance of the entity to query on.
     *
     * @param array $with
     */
    public function make(array $with = []);

    /**
     * Retrieve model by id
     * regardless of status.
     *
     * @param int $id model ID
     * @param array $with
     * @param array $columns
     * @return Model
     */
    public function byId($id, array $with = [], $columns = ['*']);

    /**
     * Get all models.
     * @param array $with
     * @param array $columns
     * @return mixed
     */
    public function all(array $with = [], $columns = ['*']);

    /**
     * Get paginated models.
     *
     * @param int   $page  Number of models per page
     * @param int   $limit Results per page
     * @param array $with  Eager load related models
     *
     * @return stdClass Object with $items && $totalItems for pagination
     */
    public function byPage($page = 1, $limit = 10, array $with = []);
}