<?php

namespace AppBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use AppBundle\Entity\User\UserAccount;
use AppBundle\Entity\User\Role;


/**
 * Description of User
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 * 
 * @author homelleon
 */
class User implements \Serializable, AdvancedUserInterface {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     * @var string 
     */
    private $username;

    /**
     * @ORM\Column(type="string", unique=true) 
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $salt;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime 
     */
    private $updated;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     * @var boolean
     */
    private $isActive;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Role",inversedBy="users")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * @var Role
     */
    private $role;

    /**
     * @ORM\OneToOne(targetEntity="UserAccount",inversedBy="user")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     * @var UserAccount  
     */
    private $userAccount;

    public function __construct() {
        $this->role = 'ROLE_USER';
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
        $this->isActive = true;
        $this->salt = "a";
    }

    public function isAccountNonExpired(): bool {
        return true;
    }

    public function isAccountNonLocked(): bool {
        return true;
    }

    public function isCredentialsNonExpired(): bool {
        return true;
    }

    public function isEnabled(): bool {
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

    public function getRoles(): array {
        return [$this->role->getRole()];
    }

    public function getRole(): Role {
        return $this->role;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getUsername() {
        return $this->username;
    }

    public function eraseCredentials() {}

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username): User {
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
    public function setEmail($email): User {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password): User {
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
    public function setSalt($salt): User {
        $this->salt = $salt;

        return $this;
    }
        
    public function getSalt() {
        return null;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return User
     */
    public function setCreated(\DateTime $created): User {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated(): \DateTime {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return User
     */
    public function setUpdated(\DateTime $updated): User {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated(): \DateTime {
        return $this->updated;
    }

    /**
     * Set userAccount
     *
     * @param UserAccount $userAccount
     *
     * @return User
     */
    public function setUserAccount(UserAccount $userAccount = null): User {
        $this->userAccount = $userAccount;

        return $this;
    }

    /**
     * Get userAccount
     *
     * @return UserAccount
     */
    public function getUserAccount() {
        return $this->userAccount;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive(bool $isActive) {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive(): bool {
        return $this->isActive;
    }

    /**
     * Set role
     *
     * @param Role $role
     *
     * @return User
     */
    public function setRole(Role $role): User {
        $this->role = $role;

        return $this;
    }

}
