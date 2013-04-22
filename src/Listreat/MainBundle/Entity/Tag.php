<?php

namespace Listreat\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \FPN\TagBundle\Entity\Tag as BaseTag;

/**
 * Listreat\MainBundle\Entity\Tag
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tag extends BaseTag
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Tagging", mappedBy="tag", fetch="EAGER")
     **/
    protected $tagging;
}