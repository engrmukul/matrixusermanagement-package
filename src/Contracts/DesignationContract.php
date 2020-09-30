<?php

namespace Mukul\Matrixusermanagement\Contracts;

/**
 * Interface DesignationContract
 * @package Mukul\Matrixusermanagement\Contracts
 */
interface DesignationContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function designationList(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findDesignationById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createDesignation(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateDesignation(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteDesignation($id, array $params);

}
