<?php

namespace Listreat\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \FPN\TagBundle\Entity\Tagging as BaseTagging;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Listreat\MainBundle\Entity\Tagging
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="tagging_idx", columns={"tag_id", "resource_type", "resource_id"})})
 * @ORM\Entity
 */
class Tagging extends BaseTagging
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
     * @ORM\ManyToOne(targetEntity="Tag")
     * @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     **/
    protected $tag;
}