<?php

namespace AppBundle\Entity\User;

use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="role")
 *
 */
class Role implements RoleInterface {

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
     * @var \Doctine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="User", mappedBy="role")
     */
    private $users;

    public function __construct() {
        $this->users = new ArrayCollection();
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Role
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User\User $user
     *
     * @return Role
     */
    public function addUser(\AppBundle\Entity\User\User $user) {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User\User $user
     */
    public function removeUser(\AppBundle\Entity\User\User $user) {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers() {
        return $this->users;
    }

}
