<?php

/**
 * BaseStaff
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $sf_guard_user_id
 * @property string $ip_address
 * @property integer $session_key
 * @property sfGuardUser $User
 * @property Doctrine_Collection $ShippingTransaction
 * 
 * @method integer             getId()                  Returns the current record's "id" value
 * @method integer             getSfGuardUserId()       Returns the current record's "sf_guard_user_id" value
 * @method string              getIpAddress()           Returns the current record's "ip_address" value
 * @method integer             getSessionKey()          Returns the current record's "session_key" value
 * @method sfGuardUser         getUser()                Returns the current record's "User" value
 * @method Doctrine_Collection getShippingTransaction() Returns the current record's "ShippingTransaction" collection
 * @method Staff               setId()                  Sets the current record's "id" value
 * @method Staff               setSfGuardUserId()       Sets the current record's "sf_guard_user_id" value
 * @method Staff               setIpAddress()           Sets the current record's "ip_address" value
 * @method Staff               setSessionKey()          Sets the current record's "session_key" value
 * @method Staff               setUser()                Sets the current record's "User" value
 * @method Staff               setShippingTransaction() Sets the current record's "ShippingTransaction" collection
 * 
 * @package    primal
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseStaff extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('staff');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('sf_guard_user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ip_address', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('session_key', 'integer', 10, array(
             'type' => 'integer',
             'length' => 10,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'sf_guard_user_id',
             'foreign' => 'id',
             'onDelete' => 'cascade'));

        $this->hasMany('ShippingTransaction', array(
             'local' => 'id',
             'foreign' => 'staff_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}