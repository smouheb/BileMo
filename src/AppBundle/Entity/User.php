<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;
use FOS\UserBundle\Model\User as BaseUser;
use AppBundle\Entity\EntityUpdate;

/**
 * User
 *
 * @ORM\Table(name="user")
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 *
 * @Serializer\ExclusionPolicy("all")
 *
 * @Hateoas\Relation(
 *     "self",
 *     href= @Hateoas\Route(
 *      "Users",
 *      parameters={ "id" = "expr(object.getId())" },
 *      absolute=true
 *     )
 * )
 *
 * @Hateoas\Relation(
 *     "modification",
 *     href= @Hateoas\Route(
 *      "user-modification",
 *      parameters={ "id" = "expr(object.getId())" },
 *      absolute=true,
 *     )
 * )
 *
 * @Hateoas\Relation(
 *     "delete",
 *     href= @Hateoas\Route(
 *      "user-deletion",
 *      parameters={ "id" = "expr(object.getId())" },
 *      absolute=true,
 *     )
 * )
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     *
     * @ORM\Id
     *
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\EntityUpdate", cascade={"persist"}, mappedBy="entity_id")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdat", type="datetime")
     *
     */
    protected $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedat", type="datetime", nullable=true)
     *
     */
    protected $updatedat;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\EntityUpdate", cascade={"persist"}, mappedBy="lastupdateddate"),
     * @ORM\JoinColumn(nullable=false)
     */
    protected $entityupdate;



    /**
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer")
     *
     */
    protected $client;


    public function __construct()
    {
        parent::__construct();
        $this->createdat = new \DateTime();
        $this->entityupdate = new ArrayCollection();

    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return User
     */
    public function setCreatedAt($createdat)
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * Get createdat
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdat;
    }

    /**
     * Set updatedat
     *
     * @param \DateTime $updatedat
     *
     * @return User
     */
    public function setUpdatedAt($updatedat)
    {
        $this->updatedat = $updatedat;

        return $this;
    }

    /**
     * Get updatedat
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedat;
    }

    /**
     * Set client
     *
     * @param integer $client
     *
     * @return User
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return integer
     */
    public function getClient()
    {
        return $this->client;
    }


    /**
     * Add entityupdate
     *
     * @param \AppBundle\Entity\EntityUpdate $entityupdate
     *
     * @return User
     */
    public function addEntityupdate(\AppBundle\Entity\EntityUpdate $entityupdate)
    {
        $this->entityupdate[] = $entityupdate;

        return $this;
    }

    /**
     * Remove entityupdate
     *
     * @param \AppBundle\Entity\EntityUpdate $entityupdate
     */
    public function removeEntityupdate(\AppBundle\Entity\EntityUpdate $entityupdate)
    {
        $this->entityupdate->removeElement($entityupdate);
    }

    /**
     * Get entityupdate
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntityupdate()
    {
        return $this->entityupdate;
    }
}
