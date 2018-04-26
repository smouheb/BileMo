<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Hateoas\Configuration\Annotation as Hateoas;

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
class User
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
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     *
     * @Assert\Type("string")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     *
     * @Assert\Type("string")
     */
    private $email;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdat", type="datetime")
     *
     * @Serializer\Expose()
     */
    private $createdat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedat", type="datetime", nullable=true)
     */
    private $updatedat;

    /**
     * @var string
     *
     * @ORM\Column(name="client_id", type="integer")
     *
     * @Serializer\Expose()
     *
     * @Assert\NotBlank()
     */
    private $client;


    public function __construct()
    {
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
     * @param string $client
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
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }
}
