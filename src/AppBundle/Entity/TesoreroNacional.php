<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TesoreroNacional
 *
 * @ORM\Table(name="tesorero_nacional")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TesoreroNacionalRepository")
 */
class TesoreroNacional extends Usuario
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

