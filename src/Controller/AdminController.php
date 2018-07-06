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
use App\Entity\Group;
use App\Entity\RegularUser;
use App\Entity\UserDevice;
use App\Repository\DeviceRepository;
use Doctrine\DBAL\Types\ArrayType;
use Doctrine\DBAL\Types\SimpleArrayType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\EasyAdminFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\ResolvedFormType;

class AdminController extends BaseAdminController
{
    /**
     * @return EntityManager
     */
    private function getEm()
    {
        return $this->get("doctrine.orm.entity_manager");
    }

    /**
     * @Route("/dashboard", name="backend_dashboard")
     * @Template("dashboard.html.twig")
     */
    public function backendDashboardAction()
    {
        // devices per client
        $repository = $this->getDoctrine()->getManager()->getRepository('App\Entity\Device');
        $result = array();
//      chart1
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select('client.name as cliente')
            ->addSelect($qb->expr()->count('device.iddevice') . 'as cantidad')
            ->from('App\Entity\Device', 'device')
            ->join('device.client', 'client')
            ->groupBy('device.client');
        $clientDevices = $qb->getQuery()->getArrayResult();
        $chart1Labels = array();
        $chart1Data = array();
        foreach ($clientDevices as $index => $clientDevice) {
            $chart1Labels[] = $clientDevice['cliente'];
            $chart1Data[] = $clientDevice['cantidad'];
        }
        $result['chart1']['labels'] =  $chart1Labels;
        $result['chart1']['data'] =  $chart1Data;
//        chart2
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select('ru.name as usuario')
            ->addSelect($qb->expr()->count('device.iddevice') . 'as cantidad')
            ->from('App\Entity\RegularUser', 'ru')
            ->join('ru.devices', 'device')
            ->groupBy('ru.id');
        $userDevices = $qb->getQuery()->getArrayResult();
        $chart2Labels = array();
        $chart2Data = array();
        foreach ($userDevices as $index => $userDevice) {
            $chart2Labels[] = $userDevice['usuario'];
            $chart2Data[] = $userDevice['cantidad'];
        }
        $result['chart2']['labels'] =  $chart2Labels;
        $result['chart2']['data'] =  $chart2Data;
//        chart3
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select('g.label as grupo')
            ->addSelect($qb->expr()->count('device.iddevice') . 'as cantidad')
            ->from('App\Entity\Group', 'g')
            ->join('g.devices', 'device')
            ->groupBy('g.id');
        $groupDevices = $qb->getQuery()->getArrayResult();
        $chart3Labels = array();
        $chart3Data = array();
        foreach ($groupDevices as $index => $groupDevice) {
            $chart3Labels[] = $groupDevice['grupo'];
            $chart3Data[] = $groupDevice['cantidad'];
        }
        $result['chart3']['labels'] =  $chart3Labels;
        $result['chart3']['data'] =  $chart3Data;


//        var_dump($result);
//        exit;
        return $result;
    }


        public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    public function persistUserEntity($user)
    {
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
    public function createNewClienteEntity()
    {
//        $user = $this->get('fos_user.user_manager')->createUser();
        $client = new Client();

        return $client;
    }

    /**
     * @param Client $user
     */
    public function persistClienteEntity($user)
    {
        if(!$user->hasRole('ROLE_CLIENT'))
            $user->setRoles(['ROLE_CLIENT']);
        $user->setEnabled(true);
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::persistEntity($user);
    }

    /**
     * @param Client $user
     */
    public function updateClienteEntity($user)
    {
        if(!$user->hasRole('ROLE_CLIENT'))
            $user->addRole('ROLE_CLIENT');
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::updateEntity($user);
    }

    /**
     * @param Device $device
     */
    public function persistDispositivoEntity($device)
    {
        $client = $device->getClient();
        if(!is_null($client)){
            $userDevice = new UserDevice();
            $userDevice->setIduser($client->getId());
            $userDevice->setIddevice($device->getIddevice());
            $this->persistEntity($userDevice);
        }
    }

    public function updateDispositivoEntity($device)
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

    public function createNewUsuarioEntity()
    {
//        $user = $this->get('fos_user.user_manager')->createUser();
        $regularUser = new RegularUser();

        return $regularUser;
    }

    /**
     * @param RegularUser $user
     */
    public function persistUsuarioEntity($user)
    {
        if(!$user->hasRole('ROLE_REGULAR_USER'))
            $user->setRoles(['ROLE_REGULAR_USER']);
        $user->setEnabled(false);

        $this->get('fos_user.user_manager')->updateUser($user, false);
        $parentId = $this->getUser()->getId();
        $user->setParent($parentId);
        $user->setParentUser($this->getUser());
        parent::persistEntity($user);
    }

    /**
     * @param RegularUser $user
     */
    public function updateUsuarioEntity($user)
    {
        if(!$user->hasRole('ROLE_REGULAR_USER'))
            $user->setRoles(['ROLE_REGULAR_USER']);
//        $newPass = $user->getPlainPassword();
//        if(!is_null($newPass) || $newPass != "" ) {
//
//        }
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::updateEntity($user);
    }

    /**
     */
    public function listUsuarioAction()
    {
        $this->entity['list']['dql_filter'] = 'entity.parentUser = ' . $this->getUser()->getId();
        return parent::listAction();
    }

    /**
     * @return Group
     */
    public function createNewGrupoEntity()
    {
        $entity = parent::createNewEntity();
        $loggedUser = $this->getUser();
//        var_dump($entity);
//        exit;
        if(is_object($loggedUser)){
            $entity->setClient($loggedUser);
        }
        return $entity;
    }

    public function deleteDispositivoAction()
    {
        $keepData = $this->request->query->get('keep_data');
        if($keepData == "0")
            parent::deleteAction();
        else {
//            $device = $easyadmin['item'];
//            echo "todavia";
//            $id = $this->request->query->get('id');
            $easyadmin = $this->request->attributes->get('easyadmin');
            $device = $easyadmin['item'];
//            $device = $this->findBy('Device', $id);
            $device->setTrashed(true);
            $this->updateDispositivoEntity($device);
        }
        return $this->redirectToReferrer();
    }
}