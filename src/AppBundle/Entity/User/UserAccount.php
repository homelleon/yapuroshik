<?php

namespace AppBundle\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of User
 * @ORM\Entity
 * @ORM\Table(name="user_account")
 * 
 * @author homelleon
 */
class UserAccount {
   
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
    * @ORM\OneToOne(targetEntity="User",mappedBy="userAccount")
    * @var \User     
    */
    private $user;
    
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\File\Avatar",
     * inversedBy="userAccount")
     * @ORM\JoinColumn(name="avatar_id", referencedColumnName="id")
     * @var type     
     */
    private $avatar;
    
    /**
    * @ORM\Column(type="string", nullable=true) 
    * 
    */
    private $firstName;
    
    /**
     * @ORM\Column(type="string", nullable=true) 
     */
    private $lastName;
    
    /**
     * @ORM\Column(type="datetime", nullable=true) 
     */
    private $birthday;
    
    /**
     * @ORM\Column(type="string", nullable=true) 
     */
    private $gender;
    

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
     * Set user
     *
     * @param \User $user
     *
     * @return UserAccount
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return UserAccount
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return UserAccount
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return UserAccount
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return UserAccount
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set avatar
     *
     * @param $avatar
     *
     * @return UserAccount
     */
    public function setAvatar($avatar = null)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return \AppBundle\Entity\File\Avatar
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
}
