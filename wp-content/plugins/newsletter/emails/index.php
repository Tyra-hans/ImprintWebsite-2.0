<?php
defined('ABSPATH') || exit;

require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
require_once NEWSLETTER_INCLUDES_DIR . '/paginator.php';

$controls = new NewsletterControls();
$module = NewsletterEmails::instance();

if ($controls->is_action('copy')) {
    $original = Newsletter::instance()->get_email($_POST['btn']);
    $email = array();
    $email['subject'] = $original->subject;
    $email['message'] = $original->message;
    $email['message_text'] = $original->message_text;
    $email['send_on'] = time();
    $email['type'] = 'message';
    $email['editor'] = $original->editor;
    $email['track'] = $original->track;
    $email['options'] = $original->options;

    $module->save_email($email);
    $controls->messages .= __('Message duplicated.', 'newsletter');
}

if ($controls->is_action('delete')) {
    $module->delete_email($_POST['btn']);
    $controls->add_message_deleted();
}

if ($controls->is_action('delete_selected')) {
    $r = Newsletter::instance()->delete_email($_POST['ids']);
    $controls->messages .= $r . ' message(s) deleted';
}

/* ====================================== */
/* ======= PAGINATION CONTROLLERS ======= */
/* ====================================== */

$pagination_controller = new TNP_Pagination_Controller( NEWSLETTER_EMAILS_TABLE, 'id', [ 'type' => 'message' ] );
$emails                = $pagination_controller->get_items();

/* ====================================== */
/* ===== END PAGINATION CONTROLLERS ===== */
/* ====================================== */

?>

<div class="wrap tnp-emails tnp-emails-index" id="tnp-wrap">

    <?php include NEWSLETTER_DIR . '/tnp-header.php'; ?>

    <div id="tnp-heading">

        <h2><?php _e('Newsletters', 'newsletter') ?></h2>

    </div>

    <div id="tnp-body">

        <form method="post" action="">
            <?php $controls->init(); ?>

            <a href="<?php echo $module->get_admin_page_url('theme'); ?>" class="button-primary"><?php _e('New newsletter', 'newsletter') ?></a>
	        <?php $controls->button_confirm('delete_selected', __('Delete selected newsletters', 'newsletter')); ?>

            <?php $pagination_controller->display_paginator(); ?>

            <table class="widefat tnp-newsletters-list" style="width: 100%">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Id</th>
                        <th><?php _e('Subject', 'newsletter') ?></th>
                        <th><?php _e('Status', 'newsletter') ?></th>
                        <th><?php _e('Progress', 'newsletter') ?>&nbsp;(*)</th>
                        <th><?php _e('Date', 'newsletter') ?></th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($emails as $email) { ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?php echo $email->id; ?>"/></td>
                            <td><?php echo $email->id; ?></td>
                            <td><?php
                                if ($email->subject)
                                    echo htmlspecialchars($email->subject);
                                else
                                    echo "Newsletter #" . $email->id;
                                ?>
                            </td>

                            <td>
                                <?php $module->show_email_status_label($email) ?>
                            </td>
                            <td>
                                <?php $module->show_email_progress_bar($email, array('numbers'=>true)) ?>
                            </td>
                            <td><?php if ($email->status == 'sent' || $email->status == 'sending') echo $module->format_date($email->send_on); ?></td>
                            <td>
                                <?php echo $module->get_edit_button($email) ?>
                            </td>

                            <td>
                                <a class="button-primary" href="<?php echo NewsletterStatistics::instance()->get_statistics_url($email->id); ?>"><i class="fas fa-chart-bar"></i> <?php _e('Statistics', 'newsletter') ?></a>
                            </td>
                            <td><a class="button-primary" target="_blank" rel="noopener" href="<?php echo home_url('/')?>?na=view&id=<?php echo $email->id; ?>"><i class="fas fa-eye"></i>&nbsp;<?php _e('View', 'newsletter')?></a></td>
                            <td><?php $controls->button_copy($email->id); ?></td>
                            <td><?php $controls->button_delete($email->id); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <p>
                (*) <?php _e('Expected total at the end of the delivery may differ due to subscriptions/unsubscriptions occurred meanwhile.', 'newsletter') ?>
            </p>
        </form>
    </div>

    <?php include NEWSLETTER_DIR . '/tnp-footer.php'; ?>

</div>
