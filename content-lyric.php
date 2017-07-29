<?php

if ( ( comments_open() ) ) :

$name = 'Name&#8230';
$email = 'Email&#8230';
$website = 'Website&#8230';
$user_email = null;
$user_website = null;
$user_name = null;
$keep_open = get_option('keep_open');

if ( is_user_logged_in() ){
$current_user = wp_get_current_user();
$user_name = $current_user->user_nicename;
$user_email = $current_user->user_email;
$user_website = $current_user->user_url;
}
?>
<noscript>JavaScript is required to load the comments.</noscript>
<div class="inline-comments-container" name="comments">
<div id="inline_comments_ajax_handle" class="last-child" data-post_id="<?php echo $post->ID; ?>">
<div id="inline_comments_ajax_target" style="display: none;"></div>
<div class="inline-comments-loading-icon">Loading Comments&#8230;</div>
<input type="hidden" name="inline_comments_nonce" value="<?php print wp_create_nonce('inline_comments_nonce'); ?>" id="inline_comments_nonce" />
<?php if ( get_option('comment_registration') != 1 || is_user_logged_in() ) : ?>
<div class="inline-comments-content inline-comments-content-comment-fields">
<div class="inline-comments-p">
<form action="javascript://" method="POST" id="annotate_form">
<input type="hidden" name="inline_comments_nonce" value="<?php print wp_create_nonce('inline_comments_nonce'); ?>" id="inline_comments_nonce" />
    
    <div class="switch">
        <input name="radio" type="radio" value="optionone" id="optionone" checked>
        <label for="optionone"><?php _e( 'Meaning' ); ?></label>

        <input name="radio" type="radio" value="optiontwo" id="optiontwo">
        <label for="optiontwo" class="right"><?php _e( 'Translation' ); ?></label>

        <span aria-hidden="true"></span>
    </div>
    
    <div class=" user-fields">
    
     <?php inline_comments_profile_pic(); ?>

    
        <div class="enter-fields"> 
            <div class="row">
            <div class="inline-comments-field col-md-6"><input type="text" tabindex="5" name="user_name" id="annotate_user_name" placeholder="<?php print $name; ?>" value="<?php print $user_name; ?>"  /></div>
                <div class="inline-comments-field  col-md-6"><input type="email" required tabindex="5" name="user_email" id="annotate_user_email" placeholder="<?php print $email; ?>" value="<?php print $user_email; ?>"  /></div>
            </div> </div></div>
        
    
    
    <div id="editor"> </div>

    <input type="submit">
    
<div class="inline-comments-more-container" <?php if ( $user_email != null && isset( $keep_open ) && $keep_open != "on" ) : ?>style="display: none;"<?php endif; ?>>

    

</div>
</form>
</div>
</div>
<?php else : ?>
<div class="callout-container">
<p>Please <?php echo wp_register('','', false); ?> or <a href="<?php print wp_login_url(); ?>" class="inline-comments-login-handle">Login</a> to leave Comments</p>
</div>
<?php endif; ?>
</div>
</div>

<?php endif; ?>
