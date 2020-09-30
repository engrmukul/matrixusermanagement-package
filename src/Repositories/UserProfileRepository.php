<?php

namespace Mukul\Matrixusermanagement\Repositories;

use Mukul\Matrixusermanagement\Contracts\UserProfileContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Mukul\Matrixusermanagement\Models\SysUserProfile;
use Yajra\DataTables\Facades\DataTables;

class UserProfileRepository extends BaseRepository implements UserProfileContract
{
    /**
     * UserProfileRepository constructor.
     * @param UserProfile $model
     */
    public function __construct(SysUserProfile $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findUserProfileById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateUserProfile(array $params)
    {
        $userProfile = $this->findById($params['id']);

        $collection = collect($params)->except('_token');

        $updated_by = auth()->user()->id;

        $merge = $collection->merge(compact('updated_by'));

        $userProfile->update($merge->all());

        return $userProfile;
    }
}
