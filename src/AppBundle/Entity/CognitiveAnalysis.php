<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 7/24/17
 * Time: 9:19 PM
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\DateTimeType;
/**
 * @ORM\Entity
 * @ORM\Table(name="cognitive_analysis")
 */
class CognitiveAnalysis
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="cognitive_analysis_id", type = "integer")
     * @ORM\GeneratedValue(strategy = "IDENTITY")
     * @var integer
     */
    protected $cognitiveAnalysisId;

    /**
     * @var string
     * @ORM\Column(name="trigger", type="string", nullable=false)
     */
    protected $trigger;

    /**
     * @var string
     * @ORM\Column(name="thoughts", type="text", nullable=false)
     */
    protected $thoughts;

    /**
     * @var string
     * @ORM\Column(name="reactions", type="text", nullable=false)
     */
    protected $reactions;

    /**
     * @var string
     * @ORM\Column(name="alternative_perspectives", type="text", nullable=false)
     */
    protected $alternativePerspectives;

    /**
     * @var ApiUser
     * @ORM\ManyToOne(targetEntity="ApiUser", inversedBy="cognitiveAnalysis")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    protected $apiUser;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="arrowDown", mappedBy="cognitiveAnalysis")
     */
    protected $arrowDown;

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

    public function __construct() {

        $date = new \DateTime();
        $this->arrowDown     = new ArrayCollection();
        $this->createdAt = $date;
        $this->modifiedAt = $date;
    }

    /**
     * Get cognitiveAnalysisId
     *
     * @return integer
     */
    public function getCognitiveAnalysisId()
    {
        return $this->cognitiveAnalysisId;
    }

    /**
     * Set trigger
     *
     * @param string $trigger
     *
     * @return CognitiveAnalysis
     */
    public function setTrigger($trigger)
    {
        $this->trigger = $trigger;

        return $this;
    }

    /**
     * Get trigger
     *
     * @return string
     */
    public function getTrigger()
    {
        return $this->trigger;
    }

    /**
     * Set thoughts
     *
     * @param string $thoughts
     *
     * @return CognitiveAnalysis
     */
    public function setThoughts($thoughts)
    {
        $this->thoughts = $thoughts;

        return $this;
    }

    /**
     * Get thoughts
     *
     * @return string
     */
    public function getThoughts()
    {
        return $this->thoughts;
    }

    /**
     * Set reactions
     *
     * @param string $reactions
     *
     * @return CognitiveAnalysis
     */
    public function setReactions($reactions)
    {
        $this->reactions = $reactions;

        return $this;
    }

    /**
     * Get reactions
     *
     * @return string
     */
    public function getReactions()
    {
        return $this->reactions;
    }

    /**
     * Set alternativePerspectives
     *
     * @param string $alternativePerspectives
     *
     * @return CognitiveAnalysis
     */
    public function setAlternativePerspectives($alternativePerspectives)
    {
        $this->alternativePerspectives = $alternativePerspectives;

        return $this;
    }

    /**
     * Get alternativePerspectives
     *
     * @return string
     */
    public function getAlternativePerspectives()
    {
        return $this->alternativePerspectives;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\ApiUser $apiUser
     * @return ApiUser
     */
    public function setUser(ApiUser $user = null)
    {
        $this->apiUser = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\ApiUser
     */
    public function getUser()
    {
        return $this->apiUser;
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