<?php
/**
 * Created by PhpStorm.
 * User: aleco
 * Date: 2/04/18
 * Time: 11:51
 */

namespace App\Filter;


use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;

class FilterManager
{
    private $em;
    private $session;

    /**
     * @return EntityManager
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     * @param EntityManager $em
     * @return FilterManager
     */
    public function setEm($em)
    {
        $this->em = $em;
        return $this;
    }


    public function __construct(EntityManager $em, Session $session)
    {
        $this->em = $em;
        $this->session = $session;
    }

// ...

    public function onKernelRequest()
    {

        $roles = $this->session->get('roles');
        if(!is_array($roles))
            return;
        if(in_array('ROLE_CLIENT', $roles)){
            $userId = $this->session->get('userId');
            $this->em->getConfiguration()->addFilter('device_filter', 'App\Filter\DeviceFilter');
            $this->em->getConfiguration()->addFilter('devices_group_filter', 'App\Filter\DevicesGroupFilter');

//            enabling filter for device table
            $filter = $this->em->getFilters()->enable('device_filter');
            $filter->setParameter('userId', $userId);
//            enabling filter for devices_group table
            $filter = $this->em->getFilters()->enable('devices_group_filter');
            $filter->setParameter('userId', $userId);
        }

    }
}