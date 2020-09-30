<?php

namespace Mukul\Matrixusermanagement\Contracts;

/**
 * Interface CompanyContract
 * @package Mukul\Matrixusermanagement\Contracts
 */
interface CompanyContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function companyList(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findCompanyById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createCompany(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCompany(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteCompany($id, array $params);

}
