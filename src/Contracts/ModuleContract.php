<?php

namespace Mukul\Matrixusermanagement\Contracts;

/**
 * Interface ModuleContract
 * @package Mukul\Matrixusermanagement\Contracts
 */
interface ModuleContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function moduleList(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findModuleById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createModule(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateModule(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteModule($id, array $params);

}
