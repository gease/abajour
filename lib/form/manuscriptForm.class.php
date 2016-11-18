<?php

/**
 * manuscript form.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: manuscriptForm.class.php 170 2009-11-08 20:38:51Z я $
 */

/**
 *
 * @author я
 *
 */
class manuscriptForm extends BasemanuscriptForm
{
  public function configure()
  {
  	unset($this['id'], $this['status'], $this['city_id'], $this['review_list'],
  	      $this['user_manuscript_ref_list'], $this['reviewers_request'], $this['annotation'], $this['letter'],
  	      $this['keyword_manuscript_ref_list'], $this['keywords_freetext']);
    $this->widgetSchema['title']->setAttribute('size','50');
  }
}