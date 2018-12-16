<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://istina.ba
 * @since      1.0.0
 *
 * @package    Quranverse
 * @subpackage Quranverse/admin/partials
 */
?>
<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

<form method="post" name="quranverse-options" action="options.php">
	<?php settings_fields($this->plugin_name); ?>
<p>
	<?php _e( 'Choose from the list of available translations. Please note that you can install as many concurrent translations as you want, but in order to keep your WordPress database size sane, choose only as many as you really need.', 'quranverse' ); ?>
</p>
<?php
    $available_translations = $this->load_available_translations_list();
    $existing_translations = $this->load_existing_translations_list();

    foreach ($available_translations as $language => $translations) {
        printf('<h4>'. __( $language, 'quranverse' ).'</h4>');
        foreach ($translations as $translation){
            extract($translation);
            ?>

            <fieldset>
                <legend class="screen-reader-text"><span>Fieldset Example</span></legend>
                <label for="quranverse-translations-<?php echo $col_name ?>">
                    <input name="quranverse[translations][<?php echo $col_name ?>]" type="checkbox" id="quranverse-translations-<?php echo $col_name ?>" value="1" <?php checked(in_array($col_name, $existing_translations)) ?> />
                    <span><?php echo $translator ; ?></span>
                </label>
            </fieldset>

            <?php
        }

    }

?>

	<?php submit_button(__('Save all changes'), 'primary','submit', TRUE); ?>
</form>
