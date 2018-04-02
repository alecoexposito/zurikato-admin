<?php
/**
 * Created by PhpStorm.
 * User: aleco
 * Date: 23/03/18
 * Time: 10:42
 */

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Client;
use App\Entity\Device;
use App\Entity\RegularUser;
use App\Entity\UserDevice;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminController extends BaseAdminController
{
    /**
     * @Route("/dashboard", name="backend_dashboard")
     * @Template("dashboard.html.twig")
     */
    public function backendDashboardAction()
    {
        return array();
    }


        public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    public function persistUserEntity($user)
    {
        $user->setUsername($user->getEmail());
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::persistEntity($user);
    }

    public function updateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::updateEntity($user);
    }

    /**
     *
     */
    public function createNewClientEntity()
    {
//        $user = $this->get('fos_user.user_manager')->createUser();
        $client = new Client();

        return $client;
    }

    /**
     * @param Client $user
     */
    public function persistClientEntity($user)
    {
        if(!$user->hasRole('ROLE_CLIENT'))
            $user->setRoles(['ROLE_CLIENT']);
        $user->setUsername($user->getEmail());
        $user->setEnabled(true);
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::persistEntity($user);
    }

    /**
     * @param Client $user
     */
    public function updateClientEntity($user)
    {
        if(!$user->hasRole('ROLE_CLIENT'))
            $user->addRole('ROLE_CLIENT');
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::updateEntity($user);
    }

    /**
     * @param Device $device
     */
    public function persistDeviceEntity($device)
    {
        $client = $device->getClient();
        if(!is_null($client)){
            $userDevice = new UserDevice();
            $userDevice->setIduser($client->getId());
            $userDevice->setIddevice($device->getIddevice());
            $this->persistEntity($userDevice);
        }
    }

    public function updateDeviceEntity($device)
    {
        $client = $device->getClient();
        if(!is_null($client)){
            $repository = $this->getDoctrine()->getManager()->getRepository('App\Entity\UserDevice');
            $userDevice = $repository->findOneBy(array(
                'iddevice' => $device->getIddevice()
            ));
            if(is_null($userDevice)) {
                $userDevice = new UserDevice();
                $userDevice->setIduser($client);
                $userDevice->setIddevice($device);
                $this->persistEntity($userDevice);
            }else {
                $userDevice->setIduser($client);
                $this->updateEntity($userDevice);
            }
        }
    }

    /**
     * @param Admin $user
     */
    public function persistAdminEntity($user)
    {
        if(!$user->hasRole('ROLE_ADMIN'))
            $user->setRoles(['ROLE_ADMIN']);
        $user->setUsername($user->getEmail());
        $user->setEnabled(true);
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::persistEntity($user);
    }

    /**
     * @param Admin $user
     */
    public function updateAdminEntity($user)
    {
        if(!$user->hasRole('ROLE_ADMIN'))
            $user->addRole('ROLE_ADMIN');
//        $newPass = $user->getPlainPassword();
//        if(!is_null($newPass) || $newPass != "" ) {
//
//        }
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::updateEntity($user);
    }

    public function createNewRegularUserEntity()
    {
//        $user = $this->get('fos_user.user_manager')->createUser();
        $regularUser = new RegularUser();

        return $regularUser;
    }

    /**
     * @param RegularUser $user
     */
    public function persistRegularUserEntity($user)
    {
        if(!$user->hasRole('ROLE_REGULAR_USER'))
            $user->setRoles(['ROLE_REGULAR_USER']);
        $user->setUsername($user->getEmail());
        $user->setEnabled(true);

        $this->get('fos_user.user_manager')->updateUser($user, false);
        $parentId = $this->getUser()->getId();
        $user->setParent($parentId);
        $user->setParentUser($this->getUser());
        parent::persistEntity($user);
    }

    /**
     * @param RegularUser $user
     */
    public function updateRegularUserEntity($user)
    {
        if(!$user->hasRole('ROLE_REGULAR_USER'))
            $user->addRole('ROLE_REGULAR_USER');
//        $newPass = $user->getPlainPassword();
//        if(!is_null($newPass) || $newPass != "" ) {
//
//        }
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::updateEntity($user);
    }

    /**
     */
    public function listRegularUserAction()
    {
        $this->entity['list']['dql_filter'] = 'entity.parentUser = ' . $this->getUser()->getId();
        return parent::listAction();
    }


}