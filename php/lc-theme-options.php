<?php
add_action( 'admin_init', 'lc_theme_options_init' );

function lc_theme_options_init() {
  register_setting( 'lc_theme_options', 'lc_theme_settings' );

  add_settings_section(
    'lc_theme_options_settings_section',																			// Section ID
    __( 'Enable options', 'lorainccc' ),														      // Title
    'lc_theme_options_settings_section_callback',															// Callback
    'lc-theme-settings-options'																							  // Page
  );

  add_settings_field(
   'lc_enable_teal_buttons_field',                                            // Field ID
   __('Enable Teal Button Styles:' , 'lorainccc'),                            // Title
   'lc_teal_buttons_render',                                                  // Callback
   'lc-theme-settings-options',                                               // Page
   'lc_theme_options_settings_section'                                        // Section
  );
  add_settings_field(
    'lc_enable_drkred_buttons_field',                                            // Field ID
    __('Enable Dark Red Button Styles:' , 'lorainccc'),                            // Title
    'lc_drkred_buttons_render',                                                  // Callback
    'lc-theme-settings-options',                                               // Page
    'lc_theme_options_settings_section'                                        // Section
   );
}

function lc_theme_options() {
  ?>
 <div style="display:block; width:100%; float:left;">
  <img style="float:right;" src="<?php echo str_replace('/php/', '', plugin_dir_url( __FILE__ ))?>/assets/images/lccc-logo.png" border="0">
  <h1 style="float:left; padding: 20px 0 0 0;">LCCC Theme Options Menu</h1>
 </div>
 <form method="post" action="options.php">
  <?php
   settings_fields( 'lc_theme_options' );
   do_settings_sections( 'lc-theme-settings-options' );
   submit_button();
  ?>
  </form>
 <?php
 }


function lc_teal_buttons_render() {
  $options = get_option( 'lc_theme_settings' );
  $teal_button = isset($options['lc_enable_teal_buttons_field']) ? $options['lc_enable_teal_buttons_field'] : '';
?>

  <label class="switch">
  <input type="checkbox" name='lc_theme_settings[lc_enable_teal_buttons_field]' <?php checked( $teal_button, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
  </label>
  <p class="description" id="tagline-description">Provides teal button color options under the format menu in editor.</p>
<?php
}

function lc_drkred_buttons_render() {
  $options = get_option( 'lc_theme_settings' );
  $drkred_button = isset($options['lc_enable_drkred_buttons_field']) ? $options['lc_enable_drkred_buttons_field'] : '';
?>

  <label class="switch">
  <input type="checkbox" name='lc_theme_settings[lc_enable_drkred_buttons_field]' <?php checked( $drkred_button, 1); ?> value='1' style="display:none;">
  <div class="slider round"></div>
  </label>
  <p class="description" id="tagline-description">Provides dark red button color options under the format menu in editor.</p>
<?php
}