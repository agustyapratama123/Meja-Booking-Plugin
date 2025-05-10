<h2>Profil Saya</h2>

<?php $user = wp_get_current_user(); ?>

<ul class="profile-info">
    <li><strong>Nama:</strong> <?php echo esc_html($user->display_name); ?></li>
    <li><strong>Email:</strong> <?php echo esc_html($user->user_email); ?></li>
    <li><strong>Username:</strong> <?php echo esc_html($user->user_login); ?></li>
    <li><strong>Role:</strong> <?php echo esc_html(implode(', ', $user->roles)); ?></li>
</ul>
