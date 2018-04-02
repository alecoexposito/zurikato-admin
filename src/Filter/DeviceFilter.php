<?php

namespace App\Filter;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;


/**
 * Created by PhpStorm.
 * User: Alejandro
 * Date: 2016-02-17
 * Time: 1:01 AM
 */

class DeviceFilter extends SQLFilter
{

    /**
     * Gets the SQL query part to add to a query.
     *
     * @param ClassMetadata $targetEntity
     * @param string $targetTableAlias
     *
     * @return string The constraint SQL if there is available, empty string otherwise.
     */
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        $condition = "";
        if($targetEntity->getTableName() == "devices") {
            $userId = null;
            if($this->hasParameter("userId")){
                $userId = $this->getParameter("userId");
                    $condition = $targetTableAlias . '.user_id = ' . $userId . ' ';
            }
        }

        return $condition;
    }
}