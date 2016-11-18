<?php
/**
 * form for changing user login data.
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: _form_guard.php 146 2009-06-08 17:30:21Z я $
 */
?>

<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<div class="sf_admin_form">
  <form action="<?php echo url_for(
  array('module'=>'guard_user', 'action'=>'updateGuard')
  ); ?>" method="post">
  <?php
  /**
   * @var $form guardAdminForm
   */?>
    <?php echo $form->renderHiddenFields() ?>
    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('guard_user/form_fieldset', array('guard_user' => $guard_user, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('guard_user/form_actions', array('guard_user' => $guard_user, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>
