<?php

namespace Ibtikar\TaniaModelBundle\Validator\Constraints;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\HttpFoundation\RequestStack;

class UniqueCityItemPriceValidator extends ConstraintValidator
{
    private $translator;
    private $requestStack;

    public function __construct(RequestStack $requestStack, $translator) {
        $this->translator = $translator;
        $this->requestStack = $requestStack;
    }

    public function validate($object, Constraint $constraint)
    {
        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();
        $currentCities = array();
        foreach($object->getPrices() as $price){
            if(in_array($price->getCity()->getId(), $currentCities)){
                if($session->get('_locale') == "ar")
                    $this->context->buildViolation(str_replace("%city%", $price->getCity()->getNameAr(), $this->translator->trans($constraint->message_exists, array(), 'item')))
                        ->addViolation();
                else
                    $this->context->buildViolation(str_replace("%city%", $price->getCity()->getNameEn(), $this->translator->trans($constraint->message_exists, array(), 'item')))
                        ->addViolation();
                return;
            }
            $currentCities[] = $price->getCity()->getId();
        }
    }
}