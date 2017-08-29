<?php

namespace Ibtikar\TaniaModelBundle\Validator\Constraints;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniquePhoneValidator extends ConstraintValidator
{
    private $translator;
    private $em;

    public function __construct($translator, EntityManager $entityManager) {
        $this->translator = $translator;
        $this->em = $entityManager;
    }

    public function validate($object, Constraint $constraint)
    {
        $id = $object->getId();
        $phone = $object->getPhone();
        if($id){
            $count = $this->em->getRepository("IbtikarTaniaModelBundle:User")
                        ->createQueryBuilder('b')
                        ->select('count(b.id)')
                        ->where('b.phone = :phone')
                        ->andWhere('b.id != :id')
                        ->setParameters(array('phone'=>$phone,'id'=>$id))
                        ->getQuery()
                        ->getSingleScalarResult();
        }
        else{
            $count = $this->em->getRepository("IbtikarTaniaModelBundle:User")
                        ->createQueryBuilder('b')
                        ->select('count(b.id)')
                        ->where('b.phone = :phone')
                        ->setParameter('phone',$phone)
                        ->getQuery()
                        ->getSingleScalarResult();
        }
        if (Null!==$count) {
            if($count>0) {
                $this->context->buildViolation($this->translator->trans($constraint->message_exists, array(), 'validators'))
                    ->atPath('phone')
                    ->addViolation();
            }
         }
    }
}