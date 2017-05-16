<?php

namespace Blogger\UserBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of User
 * @ORM\Entity(repositoryClass="Blogger\UserBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 * 
 * @author homelleon
 */
class User implements \Serializable, UserInterface  {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", unique=true) 
     */
    private $username;
    
    /**
     * @ORM\Column(type="string", unique=true) 
     */
    private $email;
    
    /**
     * @ORM\Column(type="string", length=100) 
     */
    private $password;
    
    /**
     * @ORM\Column(type="string") 
     */
    private $salt;
    
    /**
     * @ORM\Column(type="datetime") 
     */
    private $created;
    
     /**
     * @ORM\Column(type="datetime") 
     */
    private $updated;  
    
    /**
     * @ORM\Column(type="smallint")
     */
    private $status;
    
     /**
     *
     * @var \Doctrine\Common\Collectopn\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Role",inversedBy="users") 
     * @ORM\JoinTable(name="users_roles")
     */
    private $roles;
    
    /**
     * @ORM\OneToOne(targetEntity="UserAccount")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     * @var type     
     */
    private $userAccount;
    
    public function __construct() {
        $this->roles = new ArrayCollection();
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
        $this->status = 1;
    }   
    
    public function serialize() {
        return serialize([$this->id]);
    }
    
    public function unserialize($serialized) {
        list($this->id) = $this->unserialize($serialized);
    }
    
    public function getRoles() {
        return $this->roles->toArray();
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getSalt() {
        return $this->salt;
    }
    
    public function getUsername() {
        return $this->username;
    }

    public function setRole($role) {
        $this->role = $role;
    }   
    
    public function eraseCredentials() {
        
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
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set created
     *
     * @param \datatime $created
     *
     * @return User
     */
    public function setCreated(\datatime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \datatime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \datatime $updated
     *
     * @return User
     */
    public function setUpdated(\datatime $updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \datatime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add role
     *
     * @param \Blogger\UserBundle\Entity\Role $role
     *
     * @return User
     */
    public function addRole(\Blogger\UserBundle\Entity\Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \Blogger\UserBundle\Entity\Role $role
     */
    public function removeRole(\Blogger\UserBundle\Entity\Role $role)
    {
        $this->roles->removeElement($role);
    }

    /**
     * Set userAccount
     *
     * @param \Blogger\UserBundle\Entity\UserAccount $userAccount
     *
     * @return User
     */
    public function setUserAccount(\Blogger\UserBundle\Entity\UserAccount $userAccount = null)
    {
        $this->userAccount = $userAccount;

        return $this;
    }

    /**
     * Get userAccount
     *
     * @return \Blogger\UserBundle\Entity\UserAccount
     */
    public function getUserAccount()
    {
        return $this->userAccount;
    }
}
