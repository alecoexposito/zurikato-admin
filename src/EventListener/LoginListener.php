<?php
/**
 * Created by PhpStorm.
 * User: Alejandro
 * Date: 2016-02-29
 * Time: 12:53 AM
 */

namespace App\EventListener;


use App\Filter\DeviceFilter;
use Doctrine\ORM\Events;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

class LoginListener implements EventSubscriberInterface
{

    /**
     *
     * @var ContainerInterface An ContainerInterface instance
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(//this is a comment
            FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'onImplicitLogin',
            SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLogin',
//            KernelEvents::REQUEST => 'onKernelRequest'
        );
    }

//    public function onKernelRequest(GetResponseEvent $event)
//    {
//        $userId = $event->getRequest()->getSession()->get("userId");
//        if(!isset($userId))
//            return;
//        $em = $this->container->get('doctrine')->getManager();
//        $filter = $em->getFilters()->getFilter("device_filter");
//        $filter->setParameter('userId', $userId);
//    }

    public function onImplicitLogin(UserEvent $event)
    {
//        $userId = $event->getUser()->getId();
//        $manager = $this->getTrialConnectorManager();
//        $staff = $manager->getStaffByUserId($userId);
//
//        if(is_object($staff)) {
//            $event->getRequest()->getSession()->set("siteId", $staff->getIdSite()->getId());
//            $event->getRequest()->getSession()->set("staffId", $staff->getId());
//            $event->getRequest()->getSession()->set("trialSiteVisitedId", $staff->getIdTrialSiteVisited());
//            $event->getRequest()->getSession()->set("sitePlanId", $manager->getSiteApprovedPlan($staff->getIdSite()->getId())->getId());
//        }

    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        $userId = $user->getId();
        $event->getRequest()->getSession()->set("userId", $userId);
        $event->getRequest()->getSession()->set("roles", $user->getRoles());
//        if($user->hasRole('ROLE_CLIENT')) {
//            $event->getRequest()->getSession()->set("userId", $userId);
//        }elseif ($user->hasRole('ROLE_ADMIN'))

//        $event->getRequest()->getSession()->set("siteId", $staff->getIdSite()->getId());

    }

} 