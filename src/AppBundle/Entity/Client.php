<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\OAuthServerBundle\Entity\Client as BaseClient;
use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClientRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Client extends BaseClient
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="clientname", type="string", length=255, nullable=true)
     */
    private $clientname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdat", type="datetime")
     */
    private $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedat", type="datetime", nullable=true)
     */
    private $updatedat;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", cascade={"remove"}, mappedBy="client")
     */
    private $user;


    public function __construct()
    {
        parent::__construct();
        $this->createdat = new \DateTime();
        $this->user = new ArrayCollection();
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
     * Set clientname
     *
     * @param string $clientname
     *
     * @return Client
     */
    public function setClientName($clientname)
    {
        $this->clientname = $clientname;

        return $this;
    }

    /**
     * Get clientname
     *
     * @return string
     */
    public function getClientName()
    {
        return $this->clientname;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return Client
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
     * @return Client
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
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Client
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set id
     *
     * @return $id
     *
     * @ORM\PrePersist()
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
