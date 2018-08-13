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
use App\Entity\Tire;
use App\Entity\TireDepth;
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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\ResolvedFormType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
        if($this->getUser()->hasRole("ROLE_CLIENT")) {
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
        $allEmployees = $this->getEm()->getRepository("App\Entity\Employee")->findBy(array(
            'vehicle' => $entity->getId()
        ));
        foreach ($allEmployees as $index => $emp) {
            $emp->setVehicle(null);
            $this->getEm()->merge($emp);
        }
        $employees = $entity->getEmployees();
        foreach ($employees as $index => $employee) {
            $employee->setVehicle($entity);
        }
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
         */
        $employeeId = $request->get('employeeId');
        $vehicleId = $request->get('vehicleId');

        $em = $this->getDoctrine()->getManager();
        $response = new JsonResponse();
        try {
            $employee = $em->getRepository('App\Entity\Employee')->find($employeeId);
            $vehicle = $em->getRepository('App\Entity\Vehicle')->find($vehicleId);
            $employee->setVehicle($vehicle);
            $em->merge($employee);
            $em->flush();
            $response->setData(array(
                'success' => true,
            ));
        } catch (\Exception $e) {

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
        if($user->hasRole('ROLE_CLIENT')) {
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
        if($user->hasRole('ROLE_CLIENT')) {
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
        if($user->hasRole('ROLE_CLIENT')) {
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
        if($user->hasRole('ROLE_CLIENT')) {
            $id = $user->getId();
            $client = $this->em->getRepository('App\Entity\Client')->find($id);
            $entity->setClient($client);
        }

        parent::persistEntity($entity);
    }

    /**
     * @param Tire $entity
     */
//    public function updateNeumaticoEntity($entity)
//    {
//        var_dump($entity);
//        exit;
//    }
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

    public function listNeumaticoAction()
    {
        if($this->getUser()->hasRole("ROLE_CLIENT")) {
            $this->entity['list']['dql_filter'] = "entity.status = 'Activo' and entity.client = " . $this->getUser()->getId();
        }
        return parent::listAction();

    }

    public function listDepositoAction()
    {
        if($this->getUser()->hasRole("ROLE_CLIENT")) {
            $this->entity['list']['dql_filter'] = "entity.status = 'En depósito' and entity.client = " . $this->getUser()->getId();
        }
        return parent::listAction();
    }

    public function listRenovarAction()
    {
        if($this->getUser()->hasRole("ROLE_CLIENT")) {
            $this->entity['list']['dql_filter'] = "entity.status = 'Enviado a renovar' and entity.client = " . $this->getUser()->getId();
        }
        return parent::listAction();

    }

    public function listBajaAction()
    {
        if($this->getUser()->hasRole("ROLE_CLIENT")) {
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

        if($this->getUser()->hasRole("ROLE_CLIENT")) {
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

        if($this->getUser()->hasRole("ROLE_CLIENT")) {
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

        if($this->getUser()->hasRole("ROLE_CLIENT")) {
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

        return $this->redirectToRoute('tires_vehicle', array(
            'id' => $id,
        ));

    }

    /**
     * @Route("/vehicle/{id}", name="tires_vehicle")
     * @Template("tires_vehicle.html.twig")
     */
    public function tiresVehiclesAction($id)
    {
        $vehicle = $this->getEm()->getRepository('App\Entity\Vehicle')->find($id);
        return array(
            'vehicle' => $vehicle
        );
    }


}