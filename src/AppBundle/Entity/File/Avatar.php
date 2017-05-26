<?php

namespace AppBundle\Entity\File;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\File\ImageBase;

/**
 * Description of Avatar
 * 
 * @ORM\Entity
 * @ORM\Table(name="avatar")
 * @author Админ
 */
class Avatar extends ImageBase {
    
    /**
     * @ORM\OneToOne(targetEntity="Blogger\BlogBundle\Entity\User\UserAccount", 
     * mappedBy="avatar")
     */
    private $userAccount;

    /**
     * Set userAccount
     *
     * @param Blogger\BlogBundle\Entity\User\UserAccount $userAccount
     *
     * @return Avatar
     */
    public function setUserAccount(Blogger\BlogBundle\Entity\User\UserAccount $userAccount = null)
    {
        $this->userAccount = $userAccount;

        return $this;
    }

    /**
     * Get userAccount
     *
     * @return Blogger\BlogBundle\Entity\User\UserAccount
     */
    public function getUserAccount()
    {
        return $this->userAccount;
    }
}
