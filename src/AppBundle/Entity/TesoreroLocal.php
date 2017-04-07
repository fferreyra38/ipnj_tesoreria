<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TesoreroLocal
 *
 * @ORM\Table(name="tesorero_local")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TesoreroLocalRepository")
 */
class TesoreroLocal extends Usuario
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return parent::getId();
    }
}

