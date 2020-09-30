<?php

namespace Mukul\Matrixusermanagement\Contracts;

/**
 * Interface UserProfileContract
 * @package Mukul\Matrixusermanagement\Contracts
 */
interface UserProfileContract
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findUserProfileById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateUserProfile(array $params);
}
