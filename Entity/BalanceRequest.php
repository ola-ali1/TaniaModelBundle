<?php

namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints AS Assert;
use Ibtikar\TaniaModelBundle\Entity\Order;

/**
 *
 * @ORM\Table(name="`order`")
 * @ORM\Entity()
 */
class BalanceRequest extends Order
{

}
