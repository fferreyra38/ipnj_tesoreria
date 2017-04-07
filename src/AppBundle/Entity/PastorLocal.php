<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PastorLocal
 *
 * @ORM\Table(name="pastor_local")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PastorLocalRepository")
 */
class PastorLocal extends Usuario
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

