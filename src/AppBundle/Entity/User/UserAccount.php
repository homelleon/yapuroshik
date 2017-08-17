<?php

namespace AppBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\File\Avatar;

/**
 * User account that describe user information.
 * 
 * @ORM\Entity
 * @ORM\Table(name="user_account")
 * 
 * @author homelleon
 */
class UserAccount {

    /**
     * Indetification number.
     * 
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @var integer
     */
    private $id;

    /**
     * User linked to that account.
     * 
     * @ORM\OneToOne(targetEntity="User",mappedBy="userAccount")
     * 
     * @var User     
     */
    private $user;

    /**
     * User image.
     * 
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\File\Avatar",
     * inversedBy="userAccount")
     * @ORM\JoinColumn(name="avatar_id", referencedColumnName="id")
     * 
     * @var Avatar|null    
     */
    private $avatar;

    /**
     * User's first name.
     * 
     * @ORM\Column(type="string", nullable=true)
     * 
     * @var string|null
     */
    private $firstName;

    /**
     * User's last name.
     * 
     * @ORM\Column(type="string", nullable=true)
     * 
     * @var string|null
     */
    private $lastName;

    /**
     * User's day  of birth.
     * 
     * @ORM\Column(type="datetime", nullable=true)
     * 
     * @var \DateTime|null
     */
    private $birthday;

    /**
     * User's gender.
     * 
     * @ORM\Column(type="string", nullable=true)
     * 
     * @var string|null
     */
    private $gender;

    /**
     * Gets id
     *
     * @return integer
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Sets user
     *
     * @param User $user
     *
     * @return UserAccount
     */
    public function setUser(User $user): UserAccount {
        $this->user = $user;
        return $this;
    }

    /**
     * Gets user
     *
     * @return User
     */
    public function getUser(): User {
        return $this->user;
    }

    /**
     * Sets firstName
     *
     * @param string $firstName
     *
     * @return UserAccount
     */
    public function setFirstName(string $firstName = null): UserAccount {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Gets firstName
     *
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Sets lastName
     *
     * @param string $lastName
     *
     * @return UserAccount
     */
    public function setLastName(string $lastName = null): UserAccount {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Gets lastName
     *
     * @return string
     */
    public function getLastName()  {
        return $this->lastName;
    }

    /**
     * Sets birthday
     *
     * @param \DateTime $birthday
     *
     * @return UserAccount
     */
    public function setBirthday(\DateTime $birthday = null): UserAccount {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * Gets birthday
     *
     * @return \DateTime
     */
    public function getBirthday() {
        return $this->birthday;
    }

    /**
     * Sets gender
     *
     * @param string $gender
     *
     * @return UserAccount
     */
    public function setGender(string $gender = null): UserAccount {
        $this->gender = $gender;
        return $this;
    }

    /**
     * Gets gender
     *
     * @return string
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     * Sets avatar
     *
     * @param $avatar
     *
     * @return UserAccount
     */
    public function setAvatar(Avatar $avatar = null): UserAccount {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * Gets avatar
     *
     * @return Avatar
     */
    public function getAvatar() {
        return $this->avatar;
    }

}
