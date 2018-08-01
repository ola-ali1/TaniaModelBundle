<?php

namespace Ibtikar\TaniaModelBundle\Service;

use Ibtikar\GoogleServicesBundle\Service\FirebaseCloudMessaging;
use Ibtikar\TaniaModelBundle\Entity\User;
use Doctrine\ORM\EntityManager;

/**
 * @author Mahmoud Mostafa <mahmoud.mostafa@ibtikar.net.sa>
 */
class UserDeviceNotification
{

    /**
     * @var EntityManager $em
     */
    private $em;

    /**
     * @var FirebaseCloudMessaging $firebaseCloudMessagingService
     */
    private $firebaseCloudMessagingService;

    /**
     * @param EntityManager $em
     * @param FirebaseCloudMessaging $firebaseCloudMessagingService
     */
    public function __construct(EntityManager $em, FirebaseCloudMessaging $firebaseCloudMessagingService)
    {
        $this->em = $em;
        $this->firebaseCloudMessagingService = $firebaseCloudMessagingService;
    }

    /**
     * @param User $user
     * @param string $title
     * @param string $body
     * @param array $data
     */
    public function sendNotificationToUser(User $user, $title, $body, array $data = array())
    {
        $this->sendNotificationToUsers(array($user->getId()), $title, $body, $data);
    }

    /**
     * @param array $usersIds
     * @param string $title
     * @param string $body
     * @param array $data
     */
    public function sendNotificationToUsers(array $usersIds, $title, $body, array $data = array())
    {
        if (count($usersIds) > 0) {
            $userDevices = $this->em->getRepository('IbtikarGoogleServicesBundle:Device')->findBy(array('user' => $usersIds));
            /* @var $userDevice \Ibtikar\GoogleServicesBundle\Entity\Device */
            foreach ($userDevices as $userDevice) {
                if ($userDevice->getType() === 'ios') {
                    $deviceNotificationCount = ((int) $userDevice->getBadgeNumber()) + 1;
                    $userDevice->setBadgeNumber($deviceNotificationCount);
                    $this->firebaseCloudMessagingService->sendNotificationToDevice($userDevice->getToken(), $title, $body, $data, $userDevice->getBadgeNumber());
                }
                if ($userDevice->getType() === 'android') {
                    $this->firebaseCloudMessagingService->sendMessageToDevice($userDevice->getToken(), array_merge($data, array('title' => $title, 'body' => $body)));
                }
            }
            $this->em->flush();
        }
    }

    /**
     * @param array $usersIds
     * @param array $data
     */
    public function sendDataNotificationToUsers(array $usersIds, array $data = array())
    {
        if (count($usersIds) > 0) {
            $userDevices = $this->em->getRepository('IbtikarGoogleServicesBundle:Device')->findBy(array('user' => $usersIds, 'type' => 'android'));
            /* @var $userDevice \Ibtikar\GoogleServicesBundle\Entity\Device */
            foreach ($userDevices as $userDevice) {
                $this->firebaseCloudMessagingService->sendMessageToDevice($userDevice->getToken(), $data);
            }
            $this->em->flush();
        }
    }

    public function sendNotificationToTopic($topic=null,$locale="ar",$titleAr, $titleEn, $bodyAr, $bodyEn,$oldStatus,$newStatus)
    {
        if ($topic) {


            $title = $locale === 'ar' ? $titleAr : $titleEn;
            $body = $locale === 'ar' ? $bodyAr : $bodyEn;
            $data = array(
                'oldStatus' => $oldStatus,
                'newStatus' => $newStatus,
                'title' => $title,
                'body' => $body
            );
            $this->firebaseCloudMessagingService->ssendMessageToTopic($topic, $data, 'high');

        }
    }
}
