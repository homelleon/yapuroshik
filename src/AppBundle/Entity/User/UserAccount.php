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
     */
    private $id;

    /**
     * User linked to that account.
     * 
     * @ORM\OneToOne(targetEntity="User",mappedBy="userAccount")
     * @var \User     
     */
    private $user;

    /**
     * User image.
     * 
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\File\Avatar",
     * inversedBy="userAccount")
     * @ORM\JoinColumn(name="avatar_id", referencedColumnName="id")
     * @var type     
     */
    private $avatar;

    /**
     * User's first name.
     * 
     * @ORM\Column(type="string", nullable=true)
     */
    private $firstName;

    /**
     * User's last name.
     * 
     * @ORM\Column(type="string", nullable=true) 
     */
    private $lastName;

    /**
     * User's day  of birth.
     * 
     * @ORM\Column(type="datetime", nullable=true) 
     */
    private $birthday;

    /**
     * User's gender.
     * 
     * @ORM\Column(type="string", nullable=true) 
     */
    private $gender;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Set user
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
     * Get user
     *
     * @return User
     */
    public function getUser(): User {
        return $this->user;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return UserAccount
     */
    public function setFirstName(string $firstName): UserAccount {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return UserAccount
     */
    public function setLastName(string $lastName): UserAccount {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return UserAccount
     */
    public function setBirthday(\DateTime $birthday): UserAccount {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday() {
        return $this->birthday;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return UserAccount
     */
    public function setGender(string $gender): UserAccount {
        $this->gender = $gender;
        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender() {
        return $this->gender;
    }

    /**
     * Set avatar
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
     * Get avatar
     *
     * @return Avatar
     */
    public function getAvatar() {
        return $this->avatar;
    }

}
