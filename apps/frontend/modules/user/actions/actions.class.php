<?php

/**
 * user actions.
 *
 * @package    primal
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('user/show?id='.$this->getUser()->getStaffId());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->staff = Doctrine_Core::getTable('Staff')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->staff);
  }

  public function executeNew(sfWebRequest $request)
  {
    if(!$this->getUser()->isAdmin()) $this->redirect('user/index');
    $this->form = new StaffForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new StaffForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($staff = Doctrine_Core::getTable('Staff')->find(array($request->getParameter('id'))), sprintf('Object staff does not exist (%s).', $request->getParameter('id')));
    $this->form = new StaffForm($staff);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($staff = Doctrine_Core::getTable('Staff')->find(array($request->getParameter('id'))), sprintf('Object staff does not exist (%s).', $request->getParameter('id')));
    $this->form = new StaffForm($staff);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($staff = Doctrine_Core::getTable('Staff')->find(array($request->getParameter('id'))), sprintf('Object staff does not exist (%s).', $request->getParameter('id')));
    $staff->delete();

    $this->redirect('user/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $staff = $form->save();

      $this->redirect('user/edit?id='.$staff->getId());
    }
  }
}
