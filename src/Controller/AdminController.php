<?php
/**
 * Created by PhpStorm.
 * User: aleco
 * Date: 23/03/18
 * Time: 10:42
 */

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\AdminUser;
use App\Entity\ApiOptions;
use App\Entity\Client;
use App\Entity\Device;
use App\Entity\DeviceModel;
use App\Entity\Employee;
use App\Entity\EmployeeVehicleLog;
use App\Entity\Group;
use App\Entity\Maintenance;
use App\Entity\PeripheralGpsData;
use App\Entity\RegularUser;
use App\Entity\SemovLog;
use App\Entity\Tire;
use App\Entity\TireDepth;
use App\Entity\User;
use App\Entity\UserDevice;
use App\Entity\Vehicle;
use App\Repository\DeviceRepository;
use Doctrine\DBAL\Types\ArrayType;
use Doctrine\DBAL\Types\SimpleArrayType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\EasyAdminFormType;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\EasyAdminGroupType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\ResolvedFormType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
//use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends BaseAdminController
{
    /**
     * @Route("/mdvr-load", name="mdvr_load")
     */
    public function mdvrLoad()
    {

        $apiOptionsRepository = $this->getEm()->getRepository(ApiOptions::class);

        /**
         * @var \JMS\Serializer\Serializer $serializer
         */
        $serializer = $this->get('jms_serializer');
//        $body = $request->getContent();
        $apiUrl = getenv('MDVR_API_URL');
        $apiUser = getenv('MDVR_API_USER');
//        $apiPass = getenv('MDVR_API_PASS');
        $apiPass = $apiOptionsRepository->findAll()[0]->getApiPass();

        // loging in to the api with the user zurikato
        $curlLogin = curl_init($apiUrl . "/StandardApiAction_login.action?account=$apiUser&password=$apiPass");
        curl_setopt($curlLogin, CURLOPT_RETURNTRANSFER, 1);
        $loginResult = curl_exec($curlLogin);
        $loginArray = json_decode($loginResult, true);
//        var_dump($loginArray);
//        exit;
        $jsession = (is_array($loginArray) && array_key_exists('jsession', $loginArray)) ? $loginArray['jsession'] : null;

        if (is_null($jsession)) {
            $this->addFlash('error', "No ha sido posible conectarse al servidor de MDVR, por favor, contacte al soporte técnico.");
        } else {
            $curl = curl_init($apiUrl . "/StandardApiAction_queryUserVehicle.action?jsession=$jsession");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            $results = json_decode($result, true);
            $vehicles = $results['vehicles'];
            $vehicleAdded = false;
            $deviceAdded = false;

            $this->getEm()->getConnection()->beginTransaction();

            try {
                $vehicleRepository = $this->getEm()->getRepository(Vehicle::class);
                foreach ($vehicles as $index => $vehicle) {
//                    var_dump($vehicle);
//                    exit;
                    if (!is_null($vehicle['nm']) && !empty($vehicle['nm'])) {
                        $vehicleTmp = $vehicleRepository->findOneBy(array(
                            'plateNumber' => $vehicle['nm']
                        ));
//                        $client = $this->getCurrentClient();

                        // si no existe el vehiculo lo agrego
                        if (is_null($vehicleTmp)) {
                            $vehicleTmp = new Vehicle();
                            $vehicleTmp->setPlateNumber($vehicle['nm']);
                            $vehicleTmp->setName($vehicle['nm']);
//                            $vehicleTmp->setClient($client);
                            $this->getEm()->persist($vehicleTmp);
                            $this->getEm()->flush();
                            $vehicleAdded = true;
                        }
                        $devices = $vehicle['dl'];
                        $deviceRepository = $this->getEm()->getRepository(Device::class);
                        foreach ($devices as $index => $device) {
                            $deviceTmp = $deviceRepository->findOneBy(array(
                                'mdvrNumber' => $device['id']
                            ));

                            if (is_null($deviceTmp)) {
                                $deviceTmp = new Device();
//                                $deviceTmp->setClient($client);
                                $deviceTmp->setMdvrNumber($device['id']);
                                $deviceTmp->setTrashed(false);
                                $deviceTmp->setPanicButton(true);
                                $deviceTmp->setAuthDevice($device['id']);
                                $deviceTmp->setLabel($device['id']);
                                $deviceModelMdvr = $this->getEm()->getRepository(DeviceModel::class)->findOneBy(array(
                                    'label' => 'MDVR'
                                ));
                                $deviceTmp->setIddevicemodel($deviceModelMdvr);
                                $this->getEm()->persist($deviceTmp);
                                $vehicleTmp->setDevice($deviceTmp);
                                $this->getEm()->merge($vehicleTmp);
                                $this->getEm()->flush();
                                $userDevice = new UserDevice();
//                                $userDevice->setIduser($client);
                                $userDevice->setIddevice($deviceTmp);
                                $this->getEm()->persist($userDevice);
                                $this->getEm()->flush();
                                $deviceAdded = true;
                            }

                        }

                    }
                }
                $this->getEm()->getConnection()->commit();
            } catch (\Exception $e) {
                $vehicleAdded = false;
                $deviceAdded = false;
                $this->getEm()->getConnection()->rollBack();
            }
            if($vehicleAdded && $deviceAdded)
                $this->addFlash('success', "Se han adicionado vehículos y dispositivos nuevos, se deben editar para completar su información.");
            elseif ($vehicleAdded)
                $this->addFlash('success', "Se han adicionado vehículos nuevos, se deben editar para completar su información.");
            elseif ($deviceAdded)
                $this->addFlash('success', "Se han adicionado dispositivos nuevos, se deben editar para completar su información.");
            else
                $this->addFlash('success', "No se han encontrado vehículos o dispositivos nuevos.");
        }





        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => 'Dispositivo',
        ));

    }

    /**
     * @return EntityManager
     */
    private function getEm()
    {
        return $this->get("doctrine.orm.entity_manager");
    }

    /**
     * @return null|Client
     */
    private function getCurrentClient()
    {
        $user = $this->getUser();
        if ($user->hasRole('ROLE_CLIENT')) {
            $id = $user->getId();
            $client = $this->getEm()->getRepository('App\Entity\Client')->find($id);
            return $client;
        }
        return null;
    }

    public function listMantenimientoAction()
    {
        if ($this->getUser()->hasRole("ROLE_CLIENT")) {
            $this->entity['list']['dql_filter'] = "entity.status = 'Pendiente' and vehicle.client = " . $this->getUser()->getId();
        }
        return parent::listAction();
    }

    public function listMantenimientoCostoAction()
    {
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => 'Mantenimiento',
        ));

    }

    public function maintenanceCostsAction()
    {
        $id = $this->request->query->get('id');

        return $this->redirectToRoute('easyadmin', array(
            'action' => 'edit',
            'entity' => 'MantenimientoCosto',
            'id' => $id
        ));
    }

    public function closeMaintenanceAction()
    {
        /**
         * @var Maintenance $entity
         */
        $id = $this->request->query->get('id');
        $entity = $this->em->getRepository('App\Entity\Maintenance')->find($id);
        $entity->setStatus(Maintenance::STATUS_CLOSED);
        $this->updateEntity($entity);

        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => 'MantenimientoCerrado',
        ));
    }

    /**
     * @param Maintenance $entity
     */
    public function updateMantenimientoCostoEntity($entity)
    {
        $descriptionCosts = $entity->getDescriptionCosts();
        foreach ($descriptionCosts as $index => $descriptionCost) {
            $descriptionCost->setMaintenance($entity);
        }

        parent::persistEntity($entity);
    }

    /**
     * @param Maintenance $entity
     */
    public function updateMantenimientoEntity($entity)
    {
        $descriptionCosts = $entity->getDescriptionCosts();
        foreach ($descriptionCosts as $index => $descriptionCost) {
            $descriptionCost->setMaintenance($entity);
        }

        parent::updateEntity($entity);
    }

    public function vehicleCheckAction()
    {
        $id = $this->request->query->get('id');

        return $this->redirectToRoute('tires_vehicle', array(
            'id' => $id,
        ));
    }

    public function updateAgregarProfundidad2Entity($tire)
    {
//        dump($tire);
//        exit;
        $this->setObservationsAndDepthsToTire($tire);
        parent::updateEntity($tire);
    }

    /**
     * @param Tire $tire
     */
    private function setObservationsAndDepthsToTire($tire)
    {
        $observations = $tire->getObservations();
        foreach ($observations as $index => $observation) {
            $observation->setTire($tire);
        }

        $depths = $tire->getDepths();
        foreach ($depths as $index => $depth) {
            $depth->setTire($tire);
        }
    }

    /**
     * @param Tire $entity
     */
    public function updateDepositoEntity($entity)
    {
        $entity->setVehicle(null);
        parent::updateEntity($entity);
    }

    public function listAgregarProfundidad2Action()
    {
//        return $this->redirectToReferrer();
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => 'Vehiculo',
        ));
    }

    public function agregarprofundidad2Action()
    {
        $id = $this->request->query->get('id');
        $entity = $this->em->getRepository('App\Entity\Tire')->find($id);

        return $this->redirectToRoute('easyadmin', array(
            'action' => 'edit',
            'id' => $id,
            'entity' => 'AgregarProfundidad2',
        ));
    }

    public function listNeumaticosVehiculoAction()
    {
        if ($this->getUser()->hasRole("ROLE_CLIENT")) {
            $this->entity['list']['dql_filter'] = "entity.vehicle = " . $this->request->query->get("idVehicle");
        }
        return parent::listAction();
    }

    public function vehicleTiresListAction()
    {
        $id = $this->request->query->get('id');
//        $entity = $this->em->getRepository('App\Entity\Vehicle')->find($id);

        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => 'NeumaticosVehiculo',
            'idVehicle' => $id
        ));
    }

    public function listAsignarAction()
    {
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => 'Neumatico',
        ));
    }

    public function getAgregarProfundidadFormOptions($entity, $view)
    {
        $formOptions = parent::getEntityFormOptions($entity, $view);
        $formOptions["allow_extra_fields"] = true;
        return $formOptions;
    }

    public function agregarprofundidadAction()
    {
        $id = $this->request->query->get('id');
        $entity = $this->em->getRepository('App\Entity\Tire')->find($id);

        return $this->redirectToRoute('easyadmin', array(
            'action' => 'edit',
            'id' => $id,
            'entity' => 'AgregarProfundidad',
        ));
    }

    /**
     * @param Vehicle $vehicle
     */
    public function removeVehiculoEntity($vehicle)
    {
        foreach ($vehicle->getTires() as $index => $tire) {
            $tire->setVehicle(null);
        }
        foreach ($vehicle->getEmployees() as $index => $employee) {
            $employee->setVehicle(null);
        }
        $vehicle->setDevice(null);
        parent::removeEntity($vehicle);
    }

    public function updateAgregarProfundidadEntity($tire)
    {
        $this->setObservationsAndDepthsToTire($tire);
        parent::updateEntity($tire);
    }

    public function listAgregarProfundidadAction()
    {
//        return $this->redirectToReferrer();
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => 'Neumatico',
        ));
    }

    /**
     * @param Vehicle $entity
     */
    public function updateVehiculoEntity($entity)
    {
//        $allEmployees = $this->getEm()->getRepository("App\Entity\Employee")->findBy(array(
//            'vehicle' => $entity->getId()
//        ));
//        foreach ($allEmployees as $index => $emp) {
//            $emp->setVehicle(null);
//            $this->getEm()->merge($emp);
//        }
//        $employees = $entity->getEmployees();
//        foreach ($employees as $index => $employee) {
//            $employee->setVehicle($entity);
//        }
        parent::updateEntity($entity);
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => 'Neumatico',
        ));
    }

    public function createVehiculoEntityFormBuilder($entity, $view)
    {
        $formBuilder = parent::createEntityFormBuilder($entity, $view);

        $id = (null !== $entity->getId()) ? $entity->getId() : 0;
        $qb = $this->getEm()->createQueryBuilder();
//        $qb->select('e')
//            ->from('App\Entity\Employee', 'e')
//            ->leftJoin('e.vehicle', 'v')
//            ->where('v is null')
//            ->orWhere('v.id = :id');
//        $qb->setParameter('id', $id);
//        dump($formBuilder);
//        $formBuilder->add('employees', EntityType::class, array(
//                'class' => 'App\Entity\Employee',
//                'query_builder' => $qb,
//                'multiple' => true,
//                'block_name' => 'custom_employees',
//                'label' => ''
//            )
//        );
        return $formBuilder;
    }

    /**
     * @Route("/custom/employee-update-vehicle", name="employee_update_vehicle")
     * @Method("POST")
     * @Template()
     */
    public function updateVehicleForEmployeeAction(Request $request)
    {
        /**
         * @var Employee $employee
         * @var Vehicle $vehicle
         * @var EntityManager $em
         */
        $employeeId = $request->get('employeeId');
        $vehicleId = $request->get('vehicleId');

        $em = $this->getDoctrine()->getManager();
        $response = new JsonResponse();
        $em->getConnection()->beginTransaction();
        try {
            $employee = $em->getRepository('App\Entity\Employee')->find($employeeId);
            $vehicle = $em->getRepository('App\Entity\Vehicle')->find($vehicleId);
            $employeeVehicleLog = new EmployeeVehicleLog();
            $employeeVehicleLog->setVehicle($vehicle);
            $employeeVehicleLog->setEmployee($employee);
            $em->persist($employeeVehicleLog);
            $employee->setVehicle($vehicle);
            $em->merge($employee);
            $em->flush();
            $em->getConnection()->commit();
            $response->setData(array(
                'success' => true,
            ));
        } catch (\Exception $e) {
            $em->getConnection()->rollBack();
            $response->setData(array(
                'success' => false,
            ));
        }
        return $response;
    }

    /**
     * @param Tire $tire
     */
    public function updateNeumaticoEntity($tire)
    {
        $this->setObservationsAndDepthsToTire($tire);
        parent::updateEntity($tire);
    }

    /**
     * @param Tire $tire
     */
    public function updateNeumaticoRenovadoEntity($tire)
    {
        $tire->setStatus("Activo");
        $this->setObservationsAndDepthsToTire($tire);
        parent::updateEntity($tire);
    }

    public function renewedAltaAction()
    {
        $id = $this->request->query->get('id');
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'edit',
            'id' => $id,
            'entity' => 'NeumaticoRenovado',
        ));
    }

    /**
     * @param Tire $entity
     */
    public function persistNeumaticoEntity($entity)
    {
        $user = $this->getUser();
        if ($user->hasRole('ROLE_CLIENT')) {
            $id = $user->getId();
            $client = $this->em->getRepository('App\Entity\Client')->find($id);
            $entity->setClient($client);
        }
        $this->setObservationsAndDepthsToTire($entity);

        parent::persistEntity($entity);
    }

    public function persistNeumaticoRenovadoEntity($entity)
    {
        $user = $this->getUser();
        if ($user->hasRole('ROLE_CLIENT')) {
            $id = $user->getId();
            $client = $this->em->getRepository('App\Entity\Client')->find($id);
            $entity->setClient($client);
        }
        $this->setObservationsAndDepthsToTire($entity);

        parent::persistEntity($entity);

    }

    /**
     * @param Vehicle $entity
     */
    public function persistVehiculoEntity($entity)
    {
        $user = $this->getUser();
        if ($user->hasRole('ROLE_CLIENT')) {
            $id = $user->getId();
            $client = $this->em->getRepository('App\Entity\Client')->find($id);
            $entity->setClient($client);
        }

        $employees = $entity->getEmployees();
        foreach ($employees as $index => $employee) {
            $employee->setVehicle($entity);
        }

        parent::persistEntity($entity);
    }

    public function persistEmpleadoEntity($entity)
    {
        $user = $this->getUser();
        if ($user->hasRole('ROLE_CLIENT')) {
            $id = $user->getId();
            $client = $this->em->getRepository('App\Entity\Client')->find($id);
            $entity->setClient($client);
        }

        parent::persistEntity($entity);
    }


    public function removeAction()
    {
        $id = $this->request->query->get('id');
        $entity = $this->em->getRepository('App\Entity\Tire')->find($id);

        return $this->redirectToRoute('easyadmin', array(
            'action' => 'edit',
            'id' => $id,
            'entity' => 'Baja',
        ));
    }

    public function renewAction()
    {
        $id = $this->request->query->get('id');
        $entity = $this->em->getRepository('App\Entity\Tire')->find($id);

        return $this->redirectToRoute('easyadmin', array(
            'action' => 'edit',
            'id' => $id,
            'entity' => 'Renovar',
        ));
    }

    /**
     * @param Tire $entity
     */
//    public function updateNeumaticoEntity($entity)
//    {
//        var_dump($entity);
//        exit;
//    }
    public function adepositoAction()
    {
        $id = $this->request->query->get('id');
        $entity = $this->em->getRepository('App\Entity\Tire')->find($id);

        return $this->redirectToRoute('easyadmin', array(
            'action' => 'edit',
            'id' => $id,
            'entity' => 'Deposito',
        ));
    }

    public function asignarAction()
    {
        $id = $this->request->query->get('id');
//        $entity = $this->em->getRepository('App\Entity\Tire')->find($id);

        return $this->redirectToRoute('easyadmin', array(
            'action' => 'edit',
            'id' => $id,
            'entity' => 'Asignar',
        ));
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
        $result['chart1']['labels'] = $chart1Labels;
        $result['chart1']['data'] = $chart1Data;
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
        $result['chart2']['labels'] = $chart2Labels;
        $result['chart2']['data'] = $chart2Data;
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
        $result['chart3']['labels'] = $chart3Labels;
        $result['chart3']['data'] = $chart3Data;


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
        if (!$user->hasRole('ROLE_CLIENT'))
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
        if (!$user->hasRole('ROLE_CLIENT'))
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
        if (!is_null($client)) {
            $userDevice = new UserDevice();
            $userDevice->setIduser($client->getId());
            $userDevice->setIddevice($device->getIddevice());
            $this->persistEntity($userDevice);
        }
    }

    /**
     * @param Admin $user
     */
    public function persistAdminEntity($user)
    {
        if (!$user->hasRole('ROLE_ADMIN'))
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
        if (!$user->hasRole('ROLE_ADMIN'))
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
        if (!$user->hasRole('ROLE_REGULAR_USER'))
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
        if (!$user->hasRole('ROLE_REGULAR_USER'))
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
        if (is_object($loggedUser)) {
            $entity->setClient($loggedUser);
        }
        return $entity;
    }

    public function deleteDispositivoAction()
    {
        $easyadmin = $this->request->attributes->get('easyadmin');
        $device = $easyadmin['item'];
//            $device = $this->findBy('Device', $id);
        $device->setTrashed(true);
        $device->setAuthDevice($device->getAuthDevice() . "_old");
        if(!is_null($device->getMdvrNumber()))
            $device->setMdvrNumber($device->getMdvrNumber() . "_old");
        $this->updateDispositivoEntity($device);
        return $this->redirectToReferrer();

    }

    /**
     * @param Device $device
     */
    public function updateDispositivoEntity($device)
    {
        $client = $device->getClient();
        $this->updateEntity($device);
        if (!is_null($client)) {
            $repository = $this->getDoctrine()->getManager()->getRepository('App\Entity\UserDevice');
            $userDevice = $repository->findOneBy(array(
                'iddevice' => $device->getIddevice()
            ));
            if (is_null($userDevice)) {
                $userDevice = new UserDevice();
                $userDevice->setIduser($client);
                $userDevice->setIddevice($device);
                $this->persistEntity($userDevice);
            } else {
//                echo 'estuve aqui';
//                exit;
                $userDevice->setIduser($client);
                $this->updateEntity($userDevice);
                $vehicle = $device->getVehicle();
                if(!is_null($vehicle)) {
                    $vehicle->setDevice(null);
                    $this->updateEntity($vehicle);
                    $device->setVehicle(null);
                    $this->updateEntity($device);
                }
            }
        }
    }

    public function listNeumaticoAction()
    {
        if ($this->getUser()->hasRole("ROLE_CLIENT")) {
            $this->entity['list']['dql_filter'] = "entity.status = 'Activo' and entity.client = " . $this->getUser()->getId();
        }
        return parent::listAction();

    }

    public function listDepositoAction()
    {
        if ($this->getUser()->hasRole("ROLE_CLIENT")) {
            $this->entity['list']['dql_filter'] = "entity.status = 'En depósito' and entity.client = " . $this->getUser()->getId();
        }
        return parent::listAction();
    }

    public function listRenovarAction()
    {
        if ($this->getUser()->hasRole("ROLE_CLIENT")) {
            $this->entity['list']['dql_filter'] = "entity.status = 'Enviado a renovar' and entity.client = " . $this->getUser()->getId();
        }
        return parent::listAction();

    }

    public function listBajaAction()
    {
        if ($this->getUser()->hasRole("ROLE_CLIENT")) {
            $this->entity['list']['dql_filter'] = "entity.status = 'Dado de baja' and entity.client = " . $this->getUser()->getId();
        }
        return parent::listAction();

    }

    public function listVehiculoAction()
    {

        $qb = $this->getEm()->createQueryBuilder();
        $qb->select('e')
            ->from('App\Entity\Employee', 'e')
            ->join('e.client', 'c')
            ->where('c.id = :clientId')
            ->andWhere('e.vehicle is null');
        $qb->setParameter("clientId", $this->getUser()->getId());
        $employees = $qb->getQuery()->getResult();

        if ($this->getUser()->hasRole("ROLE_CLIENT")) {
            $this->entity['list']['dql_filter'] = "entity.client = " . $this->getUser()->getId();
        }

//        $this->dispatch(EasyAdminEvents::PRE_LIST);

        $fields = $this->entity['list']['fields'];
        $paginator = $this->findAll($this->entity['class'], $this->request->query->get('page', 1), $this->entity['list']['max_results'], $this->request->query->get('sortField'), $this->request->query->get('sortDirection'), $this->entity['list']['dql_filter']);

//        $this->dispatch(EasyAdminEvents::POST_LIST, array('paginator' => $paginator));

        $parameters = array(
            'paginator' => $paginator,
            'fields' => $fields,
            'delete_form_template' => $this->createDeleteForm($this->entity['name'], '__id__')->createView(),
            'employees' => $employees
        );

        return $this->executeDynamicMethod('render<EntityName>Template', array('list', $this->entity['templates']['list'], $parameters));


    }

    public function listEmpleadoAction()
    {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select('v')
            ->from('App\Entity\Vehicle', 'v')
            ->join('v.client', 'c')
            ->where('c.id = :clientId');
        $qb->setParameter("clientId", $this->getUser()->getId());
        $vehicles = $qb->getQuery()->getResult();

        if ($this->getUser()->hasRole("ROLE_CLIENT")) {
            $this->entity['list']['dql_filter'] = "entity.client = " . $this->getUser()->getId();
        }

//        $this->dispatch(EasyAdminEvents::PRE_LIST);

        $fields = $this->entity['list']['fields'];
        $paginator = $this->findAll($this->entity['class'], $this->request->query->get('page', 1), $this->entity['list']['max_results'], $this->request->query->get('sortField'), $this->request->query->get('sortDirection'), $this->entity['list']['dql_filter']);

//        $this->dispatch(EasyAdminEvents::POST_LIST, array('paginator' => $paginator));

        $parameters = array(
            'paginator' => $paginator,
            'fields' => $fields,
            'delete_form_template' => $this->createDeleteForm($this->entity['name'], '__id__')->createView(),
            'vehicles' => $vehicles
        );

        return $this->executeDynamicMethod('render<EntityName>Template', array('list', $this->entity['templates']['list'], $parameters));

    }

    public function searchEmpleadoAction()
    {
        $qb = $this->getEm()->createQueryBuilder();
        $qb->select('v')
            ->from('App\Entity\Vehicle', 'v')
            ->join('v.client', 'c')
            ->where('c.id = :clientId');
        $qb->setParameter("clientId", $this->getUser()->getId());
        $vehicles = $qb->getQuery()->getResult();

        if ($this->getUser()->hasRole("ROLE_CLIENT")) {
            $this->entity['search']['dql_filter'] = "entity.client = " . $this->getUser()->getId();
        }
        $this->dispatch(EasyAdminEvents::PRE_SEARCH);

        $query = trim($this->request->query->get('query'));
        // if the search query is empty, redirect to the 'list' action
        if ('' === $query) {
            $queryParameters = array_replace($this->request->query->all(), array('action' => 'list', 'query' => null));
            $queryParameters = array_filter($queryParameters);

            return $this->redirect($this->get('router')->generate('easyadmin', $queryParameters));
        }

        $searchableFields = $this->entity['search']['fields'];
        $paginator = $this->findBy(
            $this->entity['class'],
            $query,
            $searchableFields,
            $this->request->query->get('page', 1),
            $this->entity['list']['max_results'],
            isset($this->entity['search']['sort']['field']) ? $this->entity['search']['sort']['field'] : $this->request->query->get('sortField'),
            isset($this->entity['search']['sort']['direction']) ? $this->entity['search']['sort']['direction'] : $this->request->query->get('sortDirection'),
            $this->entity['search']['dql_filter']
        );
        $fields = $this->entity['list']['fields'];

        $this->dispatch(EasyAdminEvents::POST_SEARCH, array(
            'fields' => $fields,
            'paginator' => $paginator,
        ));

        $parameters = array(
            'paginator' => $paginator,
            'fields' => $fields,
            'delete_form_template' => $this->createDeleteForm($this->entity['name'], '__id__')->createView(),
            'vehicles' => $vehicles
        );

        return $this->executeDynamicMethod('render<EntityName>Template', array('search', $this->entity['templates']['list'], $parameters));

    }

    public function vehicleTiresAction()
    {
        $id = $this->request->query->get('id');

        return $this->redirectToRoute('tires_vehicle_information', array(
            'id' => $id,
        ));

    }

    /**
     * @Route("/vehicle/{id}", name="tires_vehicle")
     * @Template("tires_vehicle.html.twig")
     */
    public function tiresVehiclesAction($id)
    {
        $vehicleCheck = $this->getEm()->getRepository('App\Entity\VehicleCheck')->find($id);
        $arrayRFIDS = [];
        $arrivedRFIDS = json_decode($vehicleCheck->getArrivedTags());


        $returnTires = array();
        $vehicleTires = $vehicleCheck->getVehicle()->getTires();
        $state = '1'; //comentar los estados ke estoy usando
        $idTag = '-1';
        $rfID = '-1';
        // $arrayRFIDS = $vehicleCheck->getVehicle()->getTagsRfids();

        foreach ($vehicleTires as $tire) {
            $tag = $tire->getControlTag();
            if ($tag != null) {
                $idTag = $tag->getId();
                $rfID = $tag->getRfid();
                $inArray = in_array($tag->getRfid(), $arrivedRFIDS);
                if ($inArray == true) {
                    $state = '1';//Neumático con tag ok
                } else if ($inArray == false) {
                    $state = '0';//Neumático que tiene tag pero no es un tag autorizado
                }
            } else {
                $state = '2';//Neumático sin tag
                $idTag = '-1';
                $rfID = '-1';
            }
            $returnTires[(string)$tire->getPosition()] = [$state, $tire, $idTag, preg_replace('/\s+/', '', $rfID)];
//            echo preg_replace('/\s+/', '',$rfID);
        }

        return array(
            'vehicleCheck' =>$vehicleCheck,
            'tires' => $returnTires,
            'vehicleCheckId' => $id
        );
    }

    /**
     * @Route("/vehicle/tiresinformation/{id}", name="tires_vehicle_information")
     * @Template("tires_vehicle_information.html.twig")
     */
    public function tiresVehiclesInformationAction($id)
    {
        $vehicle = $this->getEm()->getRepository('App\Entity\Vehicle')->find($id);

        $returnTires = array();
        $vehicleTires = $vehicle->getTires();
        $state = '1'; //comentar los estados ke estoy usando

        foreach ($vehicleTires as $tire) {
            $tag = $tire->getControlTag();
            if ($tag != null) {
                $state = '1';//Neumático con tag ok
            } else {
                $state = '2';//Neumático sin tag
            }
            $returnTires[(string)$tire->getPosition()] = [$state, $tire];
        }

        return array(
            'vehicle' => $vehicle,
            'tires' => $returnTires
        );
    }

    protected function listDispositivoDeClienteAction()
    {
        /**
         * @var Device $pageResult
         * @var PeripheralGpsData $gpsData
         */
        if ($this->getUser()->hasRole("ROLE_CLIENT")) {
            $this->dispatch(EasyAdminEvents::PRE_LIST);

            $fields = $this->entity['list']['fields'];
            $paginator = $this->findAll($this->entity['class'], $this->request->query->get('page', 1), $this->entity['list']['max_results'], $this->request->query->get('sortField'), $this->request->query->get('sortDirection'), $this->entity['list']['dql_filter']);
            $pageResults = $paginator->getCurrentPageResults();
            foreach ($pageResults as $index => $pageResult) {
                $id = $pageResult->getIddevice();
                $gpsData = $this->em->getRepository('App\Entity\PeripheralGpsData')
                    ->findOneBy(array(
                        'iddevice' => $id
                    ), array('idperipheralgps' => 'DESC'));
                if (!is_null($gpsData))
                    $pageResult->setLastGpsDate($gpsData->getCreatedat());
            }
            $this->dispatch(EasyAdminEvents::POST_LIST, array('paginator' => $paginator));

            $parameters = array(
                'paginator' => $paginator,
                'fields' => $fields,
                'delete_form_template' => $this->createDeleteForm($this->entity['name'], '__id__')->createView(),
            );

            return $this->executeDynamicMethod('render<EntityName>Template', array('list', $this->entity['templates']['list'], $parameters));
        } else {
            return parent::listAction();
        }
    }

    protected function createListQueryBuilder($entityClass, $sortDirection, $sortField = null, $dqlFilter = null)
    {

        if ($entityClass == Maintenance::class) {
            $em = $this->getEm();
            $queryBuilder = $em->createQueryBuilder()
                ->select('entity')
                ->from($this->entity['class'], 'entity')
                ->leftJoin('entity.vehicle', 'vehicle');

            if (!empty($dqlFilter)) {
                $queryBuilder->andWhere($dqlFilter);
            }
            if (null !== $sortField) {
                $queryBuilder->orderBy('entity.' . $sortField, $sortDirection ?: 'DESC');
            }

            return $queryBuilder;
        } elseif ($entityClass == SemovLog::class) {

            $startDate = $this->request->query->get("startdate");
            if($startDate) {
                $startDate = date_create_from_format("m/d/Y H:i", $startDate);
                $startDate->setTimezone(new \DateTimeZone('UTC'));
                $startDate = $startDate->format('Y-m-d H:i:00');

                $endDate = $this->request->query->get("enddate");
                $endDate = date_create_from_format("m/d/Y H:i", $endDate);
                $endDate->setTimezone(new \DateTimeZone('UTC'));
                $endDate = $endDate->format('Y-m-d H:i:00');



                $qb = parent::createListQueryBuilder($entityClass, $sortDirection, $sortField, $dqlFilter);
                $qb->andWhere("entity.createdAt between :startdate and :enddate")
                    ->setParameter("startdate", $startDate)
                    ->setParameter("enddate", $endDate);
//                var_dump($startDate);
//                var_dump($endDate);
//                var_dump($qb->getQuery()->getSQL());
//                exit;
                return $qb;
            } else {
                return parent::createListQueryBuilder($entityClass, $sortDirection, $sortField, $dqlFilter); // TODO: Change the autogenerated stub
            }
        }
        return parent::createListQueryBuilder($entityClass, $sortDirection, $sortField, $dqlFilter); // TODO: Change the autogenerated stub
    }

    /**
     * @Route("/vmslogin/{username}", name="vmslogin")
     */
    public function vmsLogin(Request $request, $username) {
//        var_dump($request);
//        exit;
        /**
         * @var User $user
         */
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(array('username' => $username));
        if(!is_null($user)) {
            $hashPass = $user->getPassword();
            $pass = $request->query->get("p");
            if($hashPass == $pass) {
                $token = new UsernamePasswordToken($user, null, "main", $user->getRoles());
                $this->get('security.token_storage')->setToken($token);
                $this->get('session')->set('_security_main', serialize($token));

                $event = new InteractiveLoginEvent($request, $token);
                $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
            }
        }

        return $this->redirect("/");

    }

    public function createNewAdministradorEntity()
    {
//        $user = $this->get('fos_user.user_manager')->createUser();
        $adminUser = new AdminUser();

        return $adminUser;
    }

    /**
     * @param AdminUser $user
     */
    public function persistAdministradorEntity($user)
    {
        if (!$user->hasRole('ROLE_ADMIN_USER'))
            $user->setRoles(['ROLE_ADMIN_USER']);
        $user->setEnabled(true);
        $clients = $user->getClients();
        foreach ($clients as $index => $client) {
            $client->setAdmin($user);

        }
        $devices = $user->getDevices();
        foreach ($devices as $index => $device) {
            $device->setAdmin($user);

        }
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::persistEntity($user);
    }

    /**
     * @param AdminUser $user
     */
    public function updateAdministradorEntity($user)
    {
        if (!$user->hasRole('ROLE_ADMIN_USER'))
            $user->addRole('ROLE_ADMIN_USER');

        $clients = $user->getClients();
        foreach ($clients as $index => $client) {
            $client->setAdmin($user);

        }
        $devices = $user->getDevices();
        foreach ($devices as $index => $device) {
            $device->setAdmin($user);

        }

        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::updateEntity($user);
    }

    public function startvpnAction()
    {
        $apiUrl = getenv('ZURIKATO_API_URL');
        $id = $this->request->query->get('id');

        $curl = curl_init($apiUrl . "/start-vpn/$id");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        $result = curl_exec($curl);
        $results = json_decode($result, true);
        if($results['success'] == true)
            $this->addFlash('success', "Se ha iniciado la vpn");
        else
            $this->addFlash('error', "Ha ocurrido un problema iniciando la vpn");
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'edit',
            'id' => $id,
            'entity' => 'Dispositivo',
        ));
    }

    public function restartbbAction()
    {
        $apiUrl = getenv('ZURIKATO_API_URL');
        $id = $this->request->query->get('id');

        $curl = curl_init($apiUrl . "/restart-bb/$id");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        $result = curl_exec($curl);
        $results = json_decode($result, true);
        if($results['success'] == true)
            $this->addFlash('success', "Se ha reiniciado la bb");
        else
            $this->addFlash('error', "Ha ocurrido un problema reiniciando la bb");
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'edit',
            'id' => $id,
            'entity' => 'Dispositivo',
        ));
    }

    public function startvpnlistAction()
    {
        $apiUrl = getenv('ZURIKATO_API_URL');
        $id = $this->request->query->get('id');

        $curl = curl_init($apiUrl . "/start-vpn/$id");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        $result = curl_exec($curl);
        $results = json_decode($result, true);
        if($results['success'] == true)
            $this->addFlash('success', "Se ha iniciado la vpn");
        else
            $this->addFlash('error', "Ha ocurrido un problema iniciando la vpn");
        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'id' => $id,
            'entity' => 'Dispositivo',
        ));
    }

}