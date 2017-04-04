<?php

namespace SocialProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 *
 * @ORM\Table(name="posts", indexes={@ORM\Index(name="timeline_id", columns={"timeline_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Posts
{
    /**
     * @var integer
     *
     * @ORM\Column(name="post_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $postId;

    /**
     * @var string
     *
     * @ORM\Column(name="post_content", type="text", length=65535, nullable=false)
     */
    private $postContent;

    /**
     * @var string
     *
     * @ORM\Column(name="post_media", type="blob", length=65535, nullable=true)
     */
    private $postMedia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post_time", type="date", nullable=false)
     */
    private $postTime;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Timeline
     *
     * @ORM\ManyToOne(targetEntity="Timeline")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="timeline_id", referencedColumnName="timeline_id")
     * })
     */
    private $timeline;


}

