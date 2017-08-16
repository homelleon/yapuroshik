<?php

namespace AppBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\User\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="role")
 *
 */
class Role extends \Symfony\Component\Security\Core\Role\Role {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true) 
     */
    private $name;

    /**
     *
     * @ORM\Column(type="string", unique=true) 
     */
    private $role;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="User", mappedBy="role")
     */
    private $users;

    public function __construct() {
        $this->users = new ArrayCollection();
    }

    public function getRole(): string {
        return $this->role;
    }

    public function setRole($role): Role {
        $this->role = $role;
        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Role
     */
    public function setName(string $name): Role {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Add user
     *
     * @param User $user
     *
     * @return Role
     */
    public function addUser(User $user): Role {
        $this->users[] = $user;
        return $this;
    }

    /**
     * Remove user
     *
     * @param User $user
     */
    public function removeUser(User $user): Role {
        $this->users->removeElement($user);
        return $this;
    }

    /**
     * Get users
     *
     * @return Collection
     */
    public function getUsers(): Collection {
        return $this->users;
    }

}
