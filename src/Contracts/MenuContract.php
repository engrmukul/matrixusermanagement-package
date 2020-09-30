<?php

namespace Mukul\Matrixusermanagement\Contracts;

/**
 * Interface MenuContract
 * @package Mukul\Matrixusermanagement\Contracts
 */
interface MenuContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function menuList(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findMenuById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createMenu(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateMenu(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteMenu($id, array $params);

}
