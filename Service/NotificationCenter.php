<?php

namespace Ibtikar\TaniaModelBundle\Service;

use Ibtikar\GoogleServicesBundle\Service\FirebaseCloudMessaging;
use Ibtikar\TaniaModelBundle\Entity\DeviceNotification;
use Ibtikar\TaniaModelBundle\Entity\User;
use Doctrine\ORM\EntityManager;

/**
 * @author Mahmoud Mostafa <mahmoud.mostafa@ibtikar.net.sa>
 */
class NotificationCenter
{

    const USER_ORDER_ASSIGNED = 'user-order-assigned';
    const USER_ORDER_CLOSED = 'user-order-closed';
    const USER_BALANCE_ORDER_ASSIGNED = 'user-balance-order-assigned';
    const USER_BALANCE_ORDER_CLOSED = 'user-blance-order-closed';

    /**
     * @var EntityManager $em
     */
    private $em;

    /**
     * @var UserDeviceNotification $userDeviceNotification
     */
    private $userDeviceNotification;

    /**
     * @param EntityManager $em
     * @param FirebaseCloudMessaging $userDeviceNotification
     */
    public function __construct(EntityManager $em, UserDeviceNotification $userDeviceNotification)
    {
        $this->em = $em;
        $this->userDeviceNotification = $userDeviceNotification;
    }

    /**
     * @param User $user
     * @param type $type
     * @param type $titleAr
     * @param type $titleEn
     * @param type $bodyAr
     * @param type $bodyEn
     * @param type $notificationLocale
     * @param array $data
     */
    public function sendNotificationToUser(User $user, $type, $titleAr, $titleEn, $bodyAr, $bodyEn, $notificationLocale = 'ar', array $data = array())
    {
        $title = $notificationLocale === 'ar' ? $titleAr : $titleEn;
        $body = $notificationLocale === 'ar' ? $bodyAr : $bodyEn;
        $this->userDeviceNotification->sendNotificationToUsers(array($user->getId()), $title, $body, $data);
        $deviceNotification = new DeviceNotification();
        $deviceNotification->setBodyAr($bodyAr);
        $deviceNotification->setBodyEn($bodyEn);
        $deviceNotification->setData($data);
        $deviceNotification->setTitleAr($titleAr);
        $deviceNotification->setTitleEn($titleEn);
        $deviceNotification->setType($type);
        $deviceNotification->setUser($user);
        $this->em->persist($deviceNotification);
        $this->em->flush();
    }
}
