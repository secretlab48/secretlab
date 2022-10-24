<?php

/**
 *  Admin Dash View
 *
 *
 *  @version    1.0
 *  @see        admin-dash.php
 *  @see        admin/admin-theme/assets (for styles)
 */

if (!defined('ABSPATH')) exit;

# Wp admin bootstrap
require_once(ABSPATH . 'wp-load.php');
require_once(ABSPATH . 'wp-admin/admin.php');
require_once(ABSPATH . 'wp-admin/admin-header.php');

?>

<section class="dash">

  <header class="dash-header">
    <h1 class="dash-header__title"><?php _e('Welcome to your Site', 'openup'); ?></h1>
    <p class="dash-header__text"><?php _e('From here you can create and manage the font-end experience.', 'openup'); ?></p>
  </header>

  <section class="dash-cards">

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url('admin.php?page=contacts'); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-phone-handset"></i>

          <h3 class="dash-card__title"><?php _e('Edit Contacts', 'openup'); ?></h3>

          <p class="dash-card__text"><?php _e('Edit global links, contacts, socials, etc.', 'openup'); ?></p>
        </div>
      </a>
    </article>

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url('edit.php?post_type=page'); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-file-empty"></i>

          <h3 class="dash-card__title"><?php _e('Manage Pages', 'openup'); ?></h3>

          <p class="dash-card__text"><?php _e('Add new pages, or manage editing', 'openup'); ?></p>
        </div>
      </a>
    </article>

    <article class="dash-card">
      <a class="dash-card__link" href="<?php echo admin_url('edit.php'); ?>">
        <div class="dash-card__content">
          <i class="dash-card__icon icon-tag"></i>

          <h3 class="dash-card__title"><?php _e('Articles', 'openup'); ?></h3>

          <p class="dash-card__text"><?php _e('Add new posts / news stories', 'openup'); ?></p>
        </div>
      </a>
    </article>
  </section>
</section>
<?php 
