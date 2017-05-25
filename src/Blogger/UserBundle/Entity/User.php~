<?php

namespace Blogger\UserBundle\Entity;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Blogger\UserBundle\Entity\UserAccount;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of User
 * @ORM\Entity(repositoryClass="Blogger\UserBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 * 
 * @author homelleon
 */
class User implements \Serializable, AdvancedUserInterface  {
    
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
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isActive;
 
    
     /**
     *
     * @ORM\ManyToOne(targetEntity="Role",inversedBy="users")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */
    private $role;
    
    /**
     * @ORM\OneToOne(targetEntity="UserAccount",inversedBy="user")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     * @var type     
     */
    private $userAccount;  
    
    public function __construct() {
        $this->role = 'ROLE_USER';
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
        $this->isActive = true;
        $this->salt = "a";
    }   
    
     public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }
    
    public function serialize() {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
            ]);
    }
    
    public function unserialize($serialized) {
        list(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
        ) = unserialize($serialized);
    }
    
    public function getRoles() {
        return [$this->role->getRole()];
    }

    public function getRole() {
        return $this->role;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getSalt() {
        return null;
    }
    
    public function getUsername() {
        return $this->username;
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
     * @param \DateTime $created
     *
     * @return User
     */
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return User
     */
    public function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
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


    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set role
     *
     * @param \Blogger\UserBundle\Entity\Role $role
     *
     * @return User
     */
    public function setRole(\Blogger\UserBundle\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }
}
