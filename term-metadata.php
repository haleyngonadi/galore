<?php

add_action( 'category_add_form_fields', 'ccp_new_term_color_field' );

function ccp_new_term_color_field() {

    wp_nonce_field( basename( __FILE__ ), 'jt_term_color_nonce' ); ?>

    <div class="form-field jt-term-color-wrap">
        <label for="jt-term-color"><?php _e( 'Category Icon', 'jt' ); ?></label>
        <input type="text" name="jt_term_color" id="jt-term-color" value="" class="jt-color-field" style="width:60%; display:inline" placeholder="fa fa-test" />
        <input type="text" name="jt_term_icon" id="jt-term-icon" value="" class="jt-icon-field" style="width:35%; display:inline" placeholder="f034" />

        
      
    </div>
<?php }


add_action( 'category_edit_form_fields', 'ccp_edit_term_color_field' );

function ccp_edit_term_color_field( $term ) {

    $default = 'fa fa-heart-o';
    $defaulticon = 'fa45';

    
    $color   = jt_get_term_color( $term->term_id, true );
    $icon   = jt_get_term_icon( $term->term_id, true );


    if ( ! $color )
        $color = $default; ?>

    <tr class="form-field jt-term-color-wrap">
        <th scope="row"><label for="jt-term-color"><?php _e( 'Category Icon', 'jt' ); ?></label></th>
        <td>
            <?php wp_nonce_field( basename( __FILE__ ), 'jt_term_color_nonce' ); ?>
            <input type="text" name="jt_term_color" id="jt-term-color" value="<?php echo esc_attr( $color ); ?>" class="jt-color-field" data-default-color="<?php echo esc_attr( $default ); ?>" />
        </td>
        <td>
            <?php wp_nonce_field( basename( __FILE__ ), 'jt_term_icon_nonce' ); ?>
            <input type="text" name="jt_term_icon" id="jt-term-icon" value="<?php echo esc_attr( $icon ); ?>" class="jt-icon-field" />
        </td>
    </tr>
<?php }

add_action( 'edit_category',   'jt_save_term_color' );
add_action( 'create_category', 'jt_save_term_color' );
add_action( 'edit_category',   'jt_save_term_icon' );
add_action( 'create_category', 'jt_save_term_icon' );

function jt_save_term_color( $term_id ) {

    if ( ! isset( $_POST['jt_term_color_nonce'] ) || ! wp_verify_nonce( $_POST['jt_term_color_nonce'], basename( __FILE__ ) ) )
        return;

    $old_color = jt_get_term_color( $term_id );
    $new_color = isset( $_POST['jt_term_color'] ) ? jt_sanitize_hex( $_POST['jt_term_color'] ) : '';

    if ( $old_color && '' === $new_color )
        delete_term_meta( $term_id, 'color' );

    else if ( $old_color !== $new_color )
        update_term_meta( $term_id, 'color', $new_color );
}


function jt_save_term_icon( $term_id ) {

    if ( ! isset( $_POST['jt_term_icon_nonce'] ) || ! wp_verify_nonce( $_POST['jt_term_icon_nonce'], basename( __FILE__ ) ) )
        return;

    $old_icon = jt_get_term_icon( $term_id );
    $new_icon = isset( $_POST['jt_term_icon'] ) ? jt_sanitize_icon( $_POST['jt_term_icon'] ) : '';

    if ( $old_icon && '' === $new_icon )
        delete_term_meta( $term_id, 'icon' );

    else if ( $old_icon !== $new_icon )
        update_term_meta( $term_id, 'icon', $new_icon );
}




add_action( 'init', 'jt_register_meta' );
add_action( 'init', 'jt_register_icon' );


function jt_register_meta() {

    register_meta( 'term', 'color', 'jt_sanitize_hex' );

}


function jt_register_icon() {

    register_meta( 'term', 'icon', 'jt_sanitize_icon' );

}


function jt_sanitize_hex( $color ) {

    $color = ltrim( $color, '#' );

    return $color;
}


function jt_sanitize_icon( $icon ) {

    $icon = ltrim( $icon, '#' );

    return $icon;
}


function jt_get_term_color( $term_id, $hash = false ) {

    $color = get_term_meta( $term_id, 'color', true );
    $color = jt_sanitize_hex( $color );

    return $color;
}


function jt_get_term_icon( $term_id, $hash = false ) {

    $icon = get_term_meta( $term_id, 'icon', true );
    $icon = jt_sanitize_icon( $icon );

    return $icon;
}





add_filter( 'manage_edit-category_columns', 'jt_edit_term_columns' );

function jt_edit_term_columns( $columns ) {

    $columns['color'] = __( 'Icon', 'jt' );

    return $columns;
}

add_filter( 'manage_category_custom_column', 'jt_manage_term_custom_column', 10, 3 );

function jt_manage_term_custom_column( $out, $column, $term_id ) {

    if ( 'color' === $column ) {

        $color = jt_get_term_color( $term_id, true );

        if ( ! $color )
            $color = '#ffffff';

        $out = sprintf( '<span class="color-block"><i class="%s" aria-hidden="true"></i></span>', esc_attr( $color ) );
    }

    return $out;
}


add_action( 'admin_enqueue_scripts', 'jt_admin_enqueue_scripts' );

function jt_admin_enqueue_scripts( $hook_suffix ) {

    if ( 'edit-tags.php' !== $hook_suffix || 'category' !== get_current_screen()->taxonomy )
        return;

    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker' );

    add_action( 'admin_head',   'jt_term_colors_print_styles' );
    add_action( 'admin_footer', 'jt_term_colors_print_scripts' );
}





function jt_term_colors_print_styles() { ?>

    <style type="text/css">
        .column-color { width: 50px; }
        .column-color .color-block { display: inline-block; padding: 5px; color: black; font-size: 17px; }
    </style>
<?php }




