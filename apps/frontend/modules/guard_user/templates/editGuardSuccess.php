<?php
/**
 * rendering _guard_form.
 *
 * По образцу админ генератора, только использует форму,связанную с таблицей
 * sf_guard_user
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: editGuardSuccess.php 145 2009-06-07 19:42:23Z я $
 * @var $form guardAdminForm
 */
?>
<?php use_helper('I18N', 'Date') ?>
<?php include_partial('guard_user/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit user login', array(), 'messages') ?></h1>

  <?php include_partial('guard_user/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('guard_user/form_header', array('guard_user' => $guard_user, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('guard_user/form_guard', array('guard_user' => $guard_user, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('guard_user/form_footer', array('guard_user' => $guard_user, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
