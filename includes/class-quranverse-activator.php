<?php

/**
 * Fired during plugin activation
 *
 * @link       https://istina.ba
 * @since      1.0.0
 *
 * @package    Quranverse
 * @subpackage Quranverse/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Quranverse
 * @subpackage Quranverse/includes
 * @author     Emir Cajic <e.cajic@gmail.com>
 */
class Quranverse_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$table_name = $wpdb->prefix.'quran';
		if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			//table not in database. Create new table
			$charset_collate = $wpdb->get_charset_collate();

			$sql = "CREATE TABLE $table_name (
					  `index` int(4),
					  `sura` int(3),
					  `aya` int(3),
					  `text` text,
					  PRIMARY KEY  (`index`)
					) $charset_collate";
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

			$row = 1;
			if (($handle = fopen(__DIR__."/sources/quran-uthmani.txt", "r")) !== FALSE) {
				while ($row<=6236) {
					$data = fgetcsv($handle, 0, "|");
					$data = array('index' => $row, 'sura' => $data[0], 'aya' => $data[1], 'text' => $data[2]);
					$format = array('%d','%d','%d','%s');
					$wpdb->insert($table_name, $data, $format);
					$row++;
				}
				fclose($handle);
			}

		}
		if (!get_option('quranverse')) {
			add_option('quranverse_needs_setup',true);
		}
	}

}
