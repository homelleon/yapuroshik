<?php

namespace Blogger\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Enquiry
 * @ORM\Entity
 * @ORM\Table(name="enquiry") 
 *
 * @author homelleon
 */
class Enquiry 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $email;
    
    /**
     * @ORM\Column(type="text", length=100)
     */
    protected $subject;
    
    protected $body;
    
}
