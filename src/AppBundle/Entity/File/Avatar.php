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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User\UserAccount", 
     * mappedBy="avatar")
     */
    private $userAccount;

    /**
     * Set userAccount
     *
     * @param AppBundle\Entity\User\UserAccount $userAccount
     *
     * @return Avatar
     */
    public function setUserAccount(AppBundle\Entity\User\UserAccount $userAccount = null)
    {
        $this->userAccount = $userAccount;

        return $this;
    }

    /**
     * Get userAccount
     *
     * @return AppBundle\Entity\User\UserAccount
     */
    public function getUserAccount()
    {
        return $this->userAccount;
    }
}
