<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Presidente
 *
 * @ORM\Table(name="presidente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PresidenteRepository")
 */
class Presidente extends Usuario
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

