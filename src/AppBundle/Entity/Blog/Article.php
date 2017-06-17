<?php

namespace AppBundle\Entity\Blog;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\User\User;
use AppBundle\Entity\Blog\Comment;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\File\Image;

/**
 * News blog entity.
 * 
 * @ORM\Entity
 * @ORM\Table(name="article") 
 * 
 */
class Article {

    /**
     * Identification number.
     * 
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Article name.
     * 
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * Entity object of author of that article.
     * 
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User")
     */
    private $author;

    /**
     * Article theme category.
     * 
     * @ORM\Column(type="string", length=100)
     */
    private $theme;

    /**
     * Image chosen for article.
     * 
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\File\Image")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image;

    /**
     * Article description.
     * 
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * Article comments array.
     * 
     * @ORM\ManyToMany(targetEntity="Comment")
     * @ORM\JoinTable(name="comments_id", 
     *  joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="comment_id", 
     *  referencedColumnName="id", unique=true)})
     * @var type 
     */
    private $comments;

    /**
     * Date when that article was created.
     * 
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * Date when that article was last time updated.
     * 
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * Array of users who liked that article.
     * 
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User\User")
     * @ORM\JoinTable(name="article_liked_users_id",
     *  joinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="user_id", 
     *  referencedColumnName="id",unique=false)})
     */
    private $liked;

    /**
     * Number of usrers that had seen that article.
     * 
     * @ORM\Column(type="integer")
     */
    private $watched;

    /**
     * Marker for deleted article.
     * <p>NOTE: that comment is not deleted from data base.<br>
     * Use correct method to do these.
     * 
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isDeleted;

    /**
     * Marker for updated article.
     * 
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $isUpdated;

    public function __construct() {
        $this->liked = new ArrayCollection();
        $this->isDeleted = false;
        $this->isUpdated = false;
        $this->watched = 0;
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
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     * 
     */
    public function setAuthor($author) {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * Set theme
     *
     * @param string $theme
     *
     */
    public function setTheme($theme) {
        $this->theme = $theme;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme() {
        return $this->theme;
    }

    /**
     * Set image
     *
     * @param $image
     * 
     */
    public function setImage($image = null) {
        $this->image = $image;
    }

    /**
     * Get image
     *
     * @return Image
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }
    
    /**
     * Get comments
     * 
     * @return Collection
     */
    public function getComments() {
        return $this->comments;
    }
    
    /**
     * Add comment
     *
     * @param Comment $comment
     */
    public function addComment(Comment $comment) {
        $this->comments[] = $comment;
    }

    /**
     * Remove comment
     *
     * @param Comment $comment
     */
    public function removeComment(Comment $comment) {
        $this->comments->removeElement($comment);
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     */
    public function setCreated($created) {
        $this->created = $created;
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
     * Set isDeleted
     *
     * @param boolean $isDeleted
     *
     * @return Article
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
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Article
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
     * Set isUpdated
     *
     * @param boolean $isUpdated
     *
     * @return Article
     */
    public function setIsUpdated($isUpdated) {
        $this->isUpdated = $isUpdated;

        return $this;
    }

    /**
     * Get isUpdated
     *
     * @return boolean
     */
    public function getIsUpdated() {
        return $this->isUpdated;
    }

    /**
     * Set watched
     *
     * @param integer $watched
     *
     * @return Article
     */
    public function setWatched($watched) {
        $this->watched = $watched;

        return $this;
    }

    /**
     * Get watched
     *
     * @return integer
     */
    public function getWatched() {
        return $this->watched;
    }

    /**
     * Add liked
     *
     * @param $user
     *
     * @return User
     */
    public function addLiked(User $user) {
        $this->liked[] = $user;

        return $this;
    }

    /**
     * Remove liked
     *
     * @param User $user
     */
    public function removeLiked(User $user) {
        $this->liked->removeElement($user);
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
