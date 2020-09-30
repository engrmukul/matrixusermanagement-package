<?php

namespace Mukul\Matrixusermanagement\Contracts;

/**
 * Interface BranchContract
 * @package Mukul\Matrixusermanagement\Contracts
 */
interface BranchContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function branchList(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findBranchById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createBranch(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBranch(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteBranch($id, array $params);

}
