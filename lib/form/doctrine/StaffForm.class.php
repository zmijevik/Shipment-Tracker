<?php

/**
 * Staff form.
 *
 * @package    primal
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class StaffForm extends BaseStaffForm
{
  public function configure()
  {
    $this->embedUser();
    $this->unsetTimestampable();
  }
}
