<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 7/24/17
 * Time: 9:40 PM
 */


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\DateTimeType;
/**
 * @ORM\Entity
 * @ORM\Table(name="arrow_down")
 */
class ArrowDown
{

    /**
     * @ORM\Id()
     * @ORM\Column(name="arrow_down_id", type = "integer")
     * @ORM\GeneratedValue(strategy = "IDENTITY")
     * @var integer
     */
    protected $arrowDownId;

    /**
     * @var \string
     * @ORM\Column(name="drillDown", type="text", nullable=false)
     */
    protected $drillDown;

    /**
     * @var \DateTime
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="modifiedAt", type="datetime", nullable=false)
     */
    protected $modifiedAt;

    /**
     * @var CognitiveAnalysis
     * @ORM\ManyToOne(targetEntity="CognitiveAnalysis", inversedBy="arrowDown")
     * @ORM\JoinColumn(name="cognitive_analysis_id", referencedColumnName="cognitive_analysis_id")
     */
    protected $cognitiveAnalysis;

    public function __construct() {

        parent::__construct();
        $date = new \DateTime();
        $this->createdAt = $date;
        $this->modifiedAt = $date;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getArrowDownId()
    {
        return $this->arrowDownId;
    }

    /**
     * Set drillDown
     *
     * @param string $drillDown
     *
     * @return ArrowDown
     */
    public function setDrillDown($drillDown)
    {
        $this->drillDown = $drillDown;

        return $this;
    }

    /**
     * Get drillDown
     *
     * @return string
     */
    public function getDrillDown()
    {
        return $this->drillDown;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return ArrowDown
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     *
     * @return ArrowDown
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }
}