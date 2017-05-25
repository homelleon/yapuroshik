<?php

namespace Blogger\FileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Avatar
 * 
 * @ORM\Entity
 * @ORM\Table(name="avatar")
 * @author Админ
 */
class Avatar extends ImageBase {
    
    /**
     * @ORM\OneToOne(targetEntity="Blogger\UserBundle\Entity\UserAccount", 
     * mappedBy="avatar")
     */
    private $userAccount;

    /**
     * Set userAccount
     *
     * @param \Blogger\UserBundle\Entity\UserAccount $userAccount
     *
     * @return Avatar
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
