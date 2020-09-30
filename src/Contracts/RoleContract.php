<?php

namespace Mukul\Matrixusermanagement\Contracts;

/**
 * Interface RoleContract
 * @package Mukul\Matrixusermanagement\Contracts
 */
interface RoleContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function roleList(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findRoleById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createRole(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateRole(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteRole($id, array $params);

}
