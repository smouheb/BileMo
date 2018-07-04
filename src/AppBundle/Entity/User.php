<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;
use FOS\UserBundle\Model\User as BaseUser;

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
 *     "create",
 *     href= @Hateoas\Route(
 *      "user-creation",
 *      parameters={ "id" = "expr(object.getId())" },
 *      absolute=true
 *     )
 * )
 *
 * @Hateoas\Relation(
 *     "delete",
 *     href= @Hateoas\Route(
 *      "user-deletion",
 *      parameters={ "id" = "expr(object.getId())" },
 *      absolute=true
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
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdat", type="datetime")
     *
     * @Serializer\Expose()
     */
    protected $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedat", type="datetime", nullable=true)
     */
    protected $updatedat;

    /**
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer")
     *
     * @Serializer\Expose()
     */
    protected $client;


    public function __construct()
    {
        parent::__construct();
        $this->createdat = new \DateTime();
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

}
