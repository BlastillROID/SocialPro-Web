<?php

namespace SocialProBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Events
 *
 * @ORM\Table(name="events")
 * @ORM\Entity
 */
class Events
{
    /**
     * @var integer
     *
     * @ORM\Column(name="event_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $eventId;

    /**
     * @var string
     *
     * @ORM\Column(name="event_name", type="string", length=50, nullable=false)
     */
    private $eventName;

    /**
     * @var string
     *
     * @ORM\Column(name="event_type", type="string", length=50, nullable=false)
     */
    private $eventType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="event_date", type="date", nullable=false)
     */
    private $eventDate;

    /**
     * @var string
     *
     * @ORM\Column(name="event_address", type="string", length=50, nullable=false)
     */
    private $eventAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="event_description", type="text", length=65535, nullable=true)
     */
    private $eventDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="event_media", type="string", length=100, nullable=true)
     */
    private $eventMedia;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=50, nullable=true)
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idEmployee;


}

