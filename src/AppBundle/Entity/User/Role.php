<?php

namespace AppBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\User\User;

/**
 * Role entity of user for assigning permissions.
 * 
 * @ORM\Entity
 * @ORM\Table(name="role")
 * 
 * @author homelleon
 */
class Role {
    
    /**
     * Identification number of current role.
     * 
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     * Showable name of current role.
     * 
     * @ORM\Column(type="string", unique=true)
     * @var string
     */
    private $name;

    /**
     * Role property for identification in security system.
     * 
     * @ORM\Column(type="string", unique=true)
     * @var string
     */
    private $role;

    /**
     * Collection of users are graduated for current role.
     * 
     * @ORM\OneToMany(targetEntity="User", mappedBy="role")
     * @var Collection
     */
    private $users;
    
    public function __construct() {
        $this->users = new ArrayCollection();
    }
    
    /**
     * Gets role property.
     * 
     * @return string value of role property
     */
    public function getRole(): string {
        return $this->role;
    }
    
    /**
     * Sets id.
     * 
     * @param string $role property for security check for permissions
     * @return Role current role entity
     */
    public function setRole(string $role): Role {
        $this->role = $role;
        return $this;
    }

    /**
     * Gets id.
     *
     * @return integer value of identification number
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Sets showable name.
     *
     * @param string $name
     *
     * @return Role current role entity
     */
    public function setName(string $name): Role {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets showable name.
     *
     * @return string value of showable role name
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Adds granted user.
     *
     * @param User $user entity for autontification of visitor.
     *
     * @return Role current role entity
     */
    public function addUser(User $user): Role {
        $this->users[] = $user;
        return $this;
    }

    /**
     * Removes granted user.
     *
     * @param User $user
     */
    public function removeUser(User $user): Role {
        $this->users->removeElement($user);
        return $this;
    }

    /**
     * Gets granted users.
     *
     * @return Collection
     */
    public function getUsers(): Collection {
        return $this->users;
    }

}
