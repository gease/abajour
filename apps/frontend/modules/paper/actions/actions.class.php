<?php


/**
 * paper actions.
 *
 * Модуль, управляющий действиями с рукописью, доступными всем (в отличие от
 * manuscrit, предназначенного для администраторской панели)
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: actions.class.php 183 2010-03-17 17:14:40Z я $
 */
class paperActions extends sfActions
{
  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */

  public function executeIndex($request)
  {
    $this->forward('default', 'module');
  }

  /**
   * Manuscript submit page display
   *
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new manuscriptCreateForm(null, array('archive_file'=>sfConfig::get('app_file_extra_archive')));
    $this->author = sfGuardUserProfilePeer::retrieveByPK($request->getParameter('user_id'));
    $this->setTemplate('submit');
  }

  /**
   * Manuscript submission controller
   *
   * Валидирует форму, отправляет информационное письмо, сохраняет рукопись и файл
   * @todo вынести почтовую функциональность в модуль mail или хелпер, сохранение файла - в форму
   */
  public function executeSubmit($request)
  {
    /* @var $request sfWebRequest */
    $this->form = new manuscriptCreateForm(null, array('archive_file'=>sfConfig::get('app_file_extra_archive')));
//  	if ($request->isMethod('post'))
//  	{
    $this->form->bind($request->getParameter('manuscript'), $request->getFiles('manuscript'));
    if ($this->form->isValid())
    {
      $this->form->save();
      $manuscript = $this->form->getObject();
      $manuscript->setStatus(manuscriptPeer::SUBMITTED);
      $manuscript->setCityId(sfGuardUserProfilePeer::retrieveByPK($this->form->getValue('corresponding'))->getcityId());
      sfProjectConfiguration::getActive()->loadHelpers('Mail');
      send_mail('Новая статья', sprintf("Поступила новая статья \"%s\" авторов %s", $manuscript->getTitle(), $this->getPartial('manuscript/authors', array('manuscript' => $manuscript))), array(), sfConfig::get('app_mail_admin'), NULL, 'html'
      );
      $manuscript->save(); //to obtain id' for action
      $file = $this->form->getValue('file');
      $filename = $manuscript->generateFilename();
      $extension = $file->getExtension($file->getOriginalExtension());
      $file->save(sfConfig::get('sf_upload_dir').'/'.$filename.$extension);
      $extra_file = $this->form->getValue('archive_file');
      if ($extra_file)
      {
        $filename = $manuscript->generateFilenameExtra();
        $extension = $extra_file->getExtension($extra_file->getOriginalExtension());
        $extra_file->save(sfConfig::get('sf_upload_dir').'/'.$filename.$extension);
      }
      //$manuscript->save();
      $user_id = $request->getParameter('user_id');
      if (empty($user_id)) $this->redirect('@manuscript');
      else {
        $this->getUser()->setFlash('info', __('Manuscript submitted successfully.'));
        $this->redirect('@user?user_id='.$user_id);
      }
    }
    else
    {
      $this->author = sfGuardUserProfilePeer::retrieveByPK($request->getParameter('user_id'));
    }
  }

  /**
   * Displays full info about the manuscript
   */
  public function executeInfo (sfWebRequest $request)
  {
    $this->manuscript = $this->getRoute()->getObject();
    $c = new Criteria();
    $c->addAscendingOrderByColumn(reviewPeer::SUBMITTED);
    $this->reviews = $this->manuscript->getreviewsJoinsfGuardUserProfile($c);
    $this->files = $this->manuscript->getFilesNumber(0);
    $this->extra_files = $this->manuscript->getExtraFilesNumber(0);
  }

  /**
   * Serves file content
   *
   * Показ файлов - рукописей
   * Запрос имеет параметры id -рукописи  и n - номер файла для этой рукописи
   * (несколько последовательных вариантов подавалось в ответ на рецензии)
   * Если форматы разные, то нумерация всё равно сквозная
   * @see manuscript::getFilename()
   */
  public function executeLinkFile(sfWebRequest $request)
  {
    //$man_id = $request->getParameter('id');
    $manuscript = $this->getRoute()->getObject();
    $action_id = $request->getParameter('action_id');
    $files = $manuscript->getFilesNumber(0);
    if (!isset($files[$action_id])) $this->redirect404();
    sfProjectConfiguration::getActive()->loadHelpers('File');
    show_file($files[$action_id]['filename']);
    return sfView::NONE;
  }

  /**
   * Serves extra file content
   *
   * Показ архивированных доп файлов
   * Запрос имеет параметры id -рукописи  и n - номер файла для этой рукописи
   * (несколько последовательных вариантов подавалось в ответ на рецензии)
   * Если форматы разные, то нумерация всё равно сквозная
   * @see manuscript::getFilename()
   */
  public function executeLinkExtraFile(sfWebRequest $request)
  {
    $manuscript = $this->getRoute()->getObject();
    $action_id = $request->getParameter('action_id');
    $filepath = $manuscript->generateFilenameExtra($action_id);
    $files = sfFinder::type('file')->name($filepath.'*')->maxdepth(1)->in(sfConfig::get('sf_upload_dir'));
    if (empty($files)) $this->redirect404();
    if (count($files)>1) throw new sfException(sprintf('Duplicate extra files %s', $filepath));
    sfProjectConfiguration::getActive()->loadHelpers('File');
    show_file($files[0]);
    return sfView::NONE;
  }

  /**
   * Reply to reviewer's remarks page
   */
  public function executeCreateReply(sfWebRequest $request)
  {
    $this->manuscript = $this->getRoute()->getObject();
    $this->form = new paperReplyForm($this->manuscript);
  }

  /**
   * Reply to reviewer's remarks processing
   *
   * @todo функционал сохранения файла и прочей обработки - в форму
   */
  public function executeSubmitReply ($request)
  {
    $this->manuscript = $this->getRoute()->getObject();
    $this->form = new paperReplyForm($this->manuscript);
    $this->form->bind($request->getParameter('paper_reply'), $request->getFiles('paper_reply'));
    if (!$this->form->isValid())
    {
      $this->setTemplate('createReply');
      return;
    }
    if ($this->form->getValue('change_reviewer'))
    {
      $this->manuscript->setStatus(manuscriptPeer::REVIEWER_REJECT);
    }
    else
    {
      $this->manuscript->setStatus(manuscriptPeer::REVIEW_FINAL);
    }
    $this->manuscript->save();
    $authors = $this->manuscript->getAuthors();
    $file = $this->form->getValue('file');
    $filename = $this->manuscript->generateFilename();
    $extension = $file->getExtension($file->getOriginalExtension());
    $file->save(sfConfig::get('sf_upload_dir').'/'.$filename.$extension);
    if (sfConfig::get('app_file_extra_archive', false))
    {
      $file = $this->form->getValue('archive_file');
      if ($file)
      {
        $filename = $this->manuscript->generateFilenameExtra();
        $extension = $file->getExtension($file->getOriginalExtension());
        $file->save(sfConfig::get('sf_upload_dir').'/'.$filename.$extension);
      }
    }
    $review = $this->manuscript->getLastReview();
    sfProjectConfiguration::getActive()->loadHelpers('Mail');
    if ($this->manuscript->getStatus() == manuscriptPeer::REVIEWER_REJECT)
      send_mail('Рецензент отклонён', sprintf("Авторы  %s статьи %s отклонили рецензента %s", $this->getPartial('manuscript/authors', array('manuscript' => $this->manuscript)), $this->manuscript->getTitle(), $review->getsfGuardUserProfile()), array(), sfConfig::get('app_mail_admin'), NULL, 'html'
      );
    if ($this->manuscript->getStatus() == manuscriptPeer::REVIEW_FINAL)
    {
      $this->sendMail($this->manuscript, $this->manuscript->getLastReview()->getsfGuardUserProfile());
    }
    if ($this->getUser()->hasCredential('admin')) $this->redirect('manuscript');
    else {
      $this->getUser()->setFlash('info', _('Reply submitted successfully.'));
      $this->redirect($this->generateUrl('user', $this->getUser()
        ->getGuardUser()
        ->getProfile()));

    }
  }

  /**
   * Notification mail to reviewer
   *
   * Письмо рецензенту о том, что авторы ответили на его замечания
   * @todo вынести отсюда
   */
  protected function sendMail ($manuscript, $to )
  {

    $culture_current = sfContext::getInstance()->getI18N()->getCulture();
    if (in_array($to->getCountry(), sfConfig::get('app_mail_ru_lang')))
      sfContext::getInstance()->getI18N()->setCulture('ru');
    else sfContext::getInstance()->getI18N()->setCulture('en');
    $subject = sfContext::getInstance()->getI18N()->__('Manuscript').' '.sfContext::getInstance()->getI18N()->__($manuscript->getStatusString());
    $body = $this->getPartial('mail/mFinal', array('to'=>$to, 'manuscript'=>$manuscript));
    $attachments = array();
    if (!$to->getsfGuardUser()->getIsActive()) return;
    else $to_email = $to->getEmail();
    $filename = $manuscript->getLastFilename();
    if (!is_null($filename)) $attachments['revised'] = $filename;
    $extra_filename = $manuscript->getLastExtraFilename();
    if (!is_null($extra_filename)) $attachments['supplement'] = $extra_filename;
    sfProjectConfiguration::getActive()->loadHelpers('Mail');
    send_mail($subject, $body, $attachments, $to_email, NULL, 'html');
    sfContext::getInstance()->getI18N()->setCulture($culture_current);
  }
}

