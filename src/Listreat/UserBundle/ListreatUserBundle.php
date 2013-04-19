<?php
// src/Listreat/UserBundle/ListreatUserBundle.php
 
namespace Listreat\UserBundle;
 
use Symfony\Component\HttpKernel\Bundle\Bundle;
 
class ListreatUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
?>
