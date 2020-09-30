<?php

namespace Mukul\Matrixusermanagement\Contracts;

/**
 * Interface DepartmentContract
 * @package Mukul\Matrixusermanagement\Contracts
 */
interface DepartmentContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function departmentList(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findDepartmentById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createDepartment(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateDepartment(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteDepartment($id, array $params);

}
