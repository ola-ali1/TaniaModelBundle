<?php
namespace Ibtikar\TaniaModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Ibtikar\TaniaModelBundle\Repository\ShiftRepository;

/**
 *
 * @ORM\Table(name="shift_days")
 * @ORM\Entity()
 */
class ShiftDays
{

    use \Ibtikar\TaniaModelBundle\Entity\TrackableTrait;

    /**
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="day_ar", type="string")
     */
    private $dayAr;

    /**
     *
     * @var string
     *
     * @ORM\Column(name="day_en", type="string")
     */
    private $dayEn;

    /**
     *
     * @var integer
     *
     * @ORM\Column(name="active", type="integer",nullable=true, options={"default" : 1})
     */
    private $active;

    /**
     *
     * @ORM\OneToMany(targetEntity="\Ibtikar\TaniaModelBundle\Entity\Shift", mappedBy="shiftDay")
     */
    protected $shifts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->shifts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dayAr
     *
     * @param string $dayAr
     *
     * @return ShiftDays
     */
    public function setDayAr($day)
    {
        $this->dayAr = $day;

        return $this;
    }

    /**
     * Get dayAr
     *
     * @return string
     */
    public function getDayAr()
    {
        return $this->dayAr;
    }

    /**
     * Set dayEn
     *
     * @param string $dayEn
     *
     * @return ShiftDays
     */
    public function setDayEn($day)
    {
        $this->dayEn = $day;

        return $this;
    }

    /**
     * Get dayEn
     *
     * @return string
     */
    public function getDayEn()
    {
        return $this->dayEn;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return ShiftDays
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer
     */
    public function getActive()
    {
        return $this->active;
    }

    public function getShiftsHtmlar()
    {
        $output = "";
        $dayShifts = $this->getShifts();
        if ($dayShifts != null && count($dayShifts) > 0) {
            for ($i = 0; $i < count($dayShifts); $i ++) {
                $shift = $dayShifts[$i];
                if ($shift->getIsDeleted() == 0) {
                    $output .= $shift->getShiftAr() . "/" . $shift->getShift() . ":-<br>";
                    $output .= "من: " . $shift->getFrom()->format('H:i') . ", إلي: " . $shift->getTo()->format('H:i') . ", أقصي عدد للطلبات في اليوم: " . $shift->getMaximumAllowedOrdersPerDay();
                    if ($i <= (count($dayShifts) - 2))
                        $output .= "<hr>";
                }
            }
        }
        return $output;
    }
    
    public function getShiftsHtmlen()
    {
        $output = "";
        $dayShifts = $this->getShifts();
        if ($dayShifts != null && count($dayShifts) > 0) {
            for ($i = 0; $i < count($dayShifts); $i ++) {
                $shift = $dayShifts[$i];
                if ($shift->getIsDeleted() == 0) {
                    $output .= $shift->getShiftAr() . "/" . $shift->getShift() . ":-<br>";
                    $output .= "From: " . $shift->getFrom()->format('H:i') . ", To: " . $shift->getTo()->format('H:i') . ", Max Allowed Orders Per Day: " . $shift->getMaximumAllowedOrdersPerDay();
                    if ($i <= (count($dayShifts) - 2))
                        $output .= "<hr>";
                }
            }
        }
        return $output;
    }

    public function getActiveStatusar()
    {
        if ($this->getActive() == 1)
            return "يوم مفعل";
        else
            return "يوم غير مفعل";
    }
    
    public function getActiveStatusen()
    {
        if ($this->getActive() == 1)
            return "Active Day";
            else
                return "Inactive Day";
    }

    /**
     * Add shift
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Shift $shift
     *
     * @return ShiftDays
     */
    public function addShift(\Ibtikar\TaniaModelBundle\Entity\Shift $shift)
    {
        $this->shifts[] = $shift;

        return $this;
    }

    /**
     * Remove shifts
     *
     * @param \Ibtikar\TaniaModelBundle\Entity\Shift $shift
     */
    public function removePrice(\Ibtikar\TaniaModelBundle\Entity\Shift $shift)
    {
        $this->shifts->removeElement($shift);
    }

    /**
     * Get shifts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getShifts()
    {
        return $this->shifts;
    }
}

