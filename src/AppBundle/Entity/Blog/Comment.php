<?php

namespace AppBundle\Entity\Blog;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\User\User;

/**
 * Article comment entity.
 * 
 * @ORM\Entity
 * @ORM\Table(name="comment") 
 * @author homelleon
 */
class Comment {

    /**
     * Identification number.
     * 
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Entity object of author of that comment.
     * 
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User")
     */
    private $author;

    /**
     * Typed text in comment.
     * 
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * Array of users who liked that comment.
     * 
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User\User")
     * @ORM\JoinTable(name="users_id", 
     *  joinColumns={@ORM\JoinColumn(name="comment_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="user_id", 
     *  referencedColumnName="id",unique=false)})
     */
    private $liked;

    /**
     * Date when that comment was created.
     * 
     * @ORM\Column(type="datetime")   
     */
    private $created;

    /**
     * Date when that comment was last time updated.
     * 
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    /**
     * Marker for deleted article.
     * <p>NOTE: that comment is not deleted from data base.<br>
     * Use correct method to do these.
     * 
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isDeleted;

    public function __construct() {
        $this->liked = new ArrayCollection();
        $this->isDeleted = false;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Comment
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Comment
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Comment
     */
    public function setUpdated($updated) {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated() {
        return $this->updated;
    }

    /**
     * Set isDeleted
     *
     * @param boolean $isDeleted
     *
     * @return Comment
     */
    public function setIsDeleted($isDeleted) {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return boolean
     */
    public function getIsDeleted() {
        return $this->isDeleted;
    }

    /**
     * Set author
     *
     * @param User $author
     *
     * @return Comment
     */
    public function setAuthor($author = null) {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return User
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * Add liked
     *
     * @param User $liked
     *
     * @return Comment
     */
    public function addLiked(AppBundle\Entity\User\User $liked) {
        $this->liked[] = $liked;

        return $this;
    }

    /**
     * Remove liked
     *
     * @param User $liked
     */
    public function removeLiked(User $liked) {
        $this->liked->removeElement($liked);
    }

    /**
     * Get liked
     *
     * @return Collection
     */
    public function getLiked() {
        return $this->liked;
    }

}
