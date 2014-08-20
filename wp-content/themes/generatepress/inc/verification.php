<?php
/**
 * These functions are needed for product activation
 * The functions below are the same throughout all addons
 * @since 0.1
 */
 
if ( ! function_exists( 'generate_verify_email' ) ) :
	add_action('generate_license_key_items','generate_verify_email', 0);
	function generate_verify_email()
	{
		$generate_customer_email = get_option( 'generate_customer_email' );
		$generate_customer_email_status = get_option( 'generate_customer_email_status' );
		
		echo '<p>' . __('Activate your addons by entering the email you purchased them with below. Save and verify, then your purchased addons will appear below for activation.','generate') . '</p>';
		 ?>			

		<table class="wp-list-table widefat fixed email" style="margin-bottom:25px;">
			<thead>
				<tr>
					<th style="" class="manage-column column-email_name" id="email_name" scope="col"><?php _e('Email','generate');?></th>
					<th style="" class="manage-column column-email_status" id="email_status" scope="col"><?php _e('Status','generate');?></th>
					<th style="" class="manage-column column-email_action" id="email_action" scope="col"><?php _e('Action','generate');?></th>
				</tr>
			</thead>

			<tbody data-wp-lists="list:license" id="the-list">
				<tr class="alternate">
					<td class="email_name column-email_name">
						<?php 
							if( $generate_customer_email !== '' && $generate_customer_email_status == 'valid' ) { ?>
								<input id="generate_customer_email" name="generate_customer_email" type="email" class="regular-text" value="<?php echo $generate_customer_email; ?>" style="display:none"  />
								<strong><?php echo $generate_customer_email;?></strong>
							<?php } else { ?>
								<input id="generate_customer_email" name="generate_customer_email" type="email" class="regular-text" value="<?php echo $generate_customer_email; ?>" style="width:100%" />
								<?php
							}
						?>
					</td>
					<td class="email_status column-email_status">
						<?php if( false !== $generate_customer_email ) { ?>

							<?php if( $generate_customer_email !== '' && $generate_customer_email_status == 'valid' ) { ?>
								<span style="color:green;"><?php _e('verified','generate'); ?></span>
							<?php } elseif ( $generate_customer_email !== '' ) { ?>
								<span style="color:red;"><?php _e('unverified','generate'); ?></span>
							<?php } ?>

						<?php } ?>
					</td>
					<td class="email_action column-email_action">
						<?php if( false !== $generate_customer_email ) { ?>

							<?php if( $generate_customer_email !== '' && $generate_customer_email_status == 'valid' ) { ?>
								<?php wp_nonce_field( 'generate_customer_email_nonce', 'generate_customer_email_nonce' ); ?>
								<input type="submit" class="button-secondary deactivate-button" name="generate_customer_email_deactivate" value="<?php _e('Deactivate','generate'); ?>"/>
								<input type="submit" class="button-secondary check-addon-button" name="generate_customer_email_activate" value="<?php _e('Refresh','generate'); ?>"/>
							<?php } elseif ( $generate_customer_email !== '' ) { ?>
								<?php wp_nonce_field( 'generate_customer_email_nonce', 'generate_customer_email_nonce' ); ?>
								<input type="submit" class="button-secondary activate-button" name="generate_customer_email_activate" value="<?php _e('Verify Email','generate'); ?>"/>
							<?php } ?>
						<?php } ?>
					</td>
				</tr>	
			</tbody>
		</table>
		
		<?php if( $generate_customer_email !== '' && $generate_customer_email_status == 'valid' ) { ?>
		<?php wp_nonce_field( 'generate_activate_all_nonce', 'generate_activate_all_nonce' ); ?>
		<input type="submit" class="button-secondary" name="generate_activate_all" value="<?php _e('Activate All','generate'); ?>"/>
		
		<table class="wp-list-table widefat fixed addons" style="margin-top:5px;">
			<thead>
				<tr>
					<th style="" class="manage-column column-addon_name" id="addon_name" scope="col"><?php _e('Product','generate');?></th>
					<th style="" class="manage-column column-addon_version" id="addon_version" scope="col"><?php _e('Version','generate');?></th>
					<th style="" class="manage-column column-addon_status" id="addon_status" scope="col"><?php _e('Status','generate');?></th>
					<th style="" class="manage-column column-addon_action" id="addon_action" scope="col"><?php _e('Action','generate');?></th>
				</tr>
			</thead>

			<tfoot>
				<tr>
					<th style="" class="manage-column column-addon_name" id="addon_name" scope="col"><?php _e('Product','generate');?></th>
					<th style="" class="manage-column column-addon_version" id="addon_version" scope="col"><?php _e('Version','generate');?></th>
					<th style="" class="manage-column column-addon_status" id="addon_status" scope="col"><?php _e('Status','generate');?></th>
					<th style="" class="manage-column column-addon_action" id="addon_action" scope="col"><?php _e('Action','generate');?></th>	
				</tr>
			</tfoot>

			<tbody data-wp-lists="list:license" id="the-list">
				<?php do_action('generate_product_table');?>
			</tbody>
		</table>
		<?php }
	}
endif;

if ( ! function_exists( 'generate_register_customer_email' ) ) :
	add_action('admin_init', 'generate_register_customer_email');
	function generate_register_customer_email() {
		// creates our settings in the options table
		register_setting('generate-settings-group', 'generate_customer_email', 'generate_sanitize_customer_email' );
	}
endif;

/***********************************************
* Gets rid of the local license status option
* when adding a new one
***********************************************/
if ( ! function_exists( 'generate_sanitize_customer_email' ) ) :
	function generate_sanitize_customer_email( $new ) {
		$generate_customer_email = get_option( 'generate_customer_email' );
		$old = $generate_customer_email;
		if( $old && $old != $new ) {
			update_option( 'generate_customer_email_status', 'invalid' ); // new license has been entered, so must reactivate
		}
		return $new;
	}
endif;

/***********************************************
* Activate the customer's email
* Check the email with the database and populate purchased downloads
***********************************************/
if ( ! function_exists( 'generate_activate_customer_email' ) ) :
	add_action('admin_init', 'generate_activate_customer_email');
	function generate_activate_customer_email() {

		if( isset( $_POST['generate_customer_email_activate'] ) ) {
		
			
			if( ! check_admin_referer( 'generate_customer_email_nonce', 'generate_customer_email_nonce' ) ) 	
				return; // get out if we didn't click the Activate button

			$generate_customer_email = get_option( 'generate_customer_email' );
			
			if ( empty($generate_customer_email) )
				return;
			
			global $wp_version;
			
				// First, let's find the products associated with the email
				$response = wp_remote_post(
					'http://generatepress.com/api/licenses/check-email.php',
					array(
						'body' => 
						array(
							'generate_action' => 'get_email',
							'email' => $generate_customer_email,
						)
					)
				);
				
				// make sure the response came back okay
				if ( is_wp_error( $response ) )
					return false;

				// Now we have our associated downloads
				$downloads = json_decode(wp_remote_retrieve_body( $response ), true);

				// If downloads exist, validate customer's email address
				// Also store which downloads are purchased in the database - may need them
				if ( !empty( $downloads ) ) :
					update_option( 'generate_purchased_products', $downloads );
					update_option( 'generate_customer_email_status', 'valid' );
				else :
					update_option( 'generate_purchased_products', '' );
					update_option( 'generate_customer_email_status', 'false' );
				endif;

		}
	}
endif;

/***********************************************
* Deactivate the customer's email
* This will deactivate all license keys
* This will descrease the site count
***********************************************/
if ( !function_exists( 'generate_deactivate_customer_email' ) ) :
	add_action('admin_init', 'generate_deactivate_customer_email');
	function generate_deactivate_customer_email() {

		// listen for our activate button to be clicked
		if( isset( $_POST['generate_customer_email_deactivate'] ) ) {

			// run a quick security check 
			if( ! check_admin_referer( 'generate_customer_email_nonce', 'generate_customer_email_nonce' ) ) 	
				return; // get out if we didn't click the Activate button
			
			// Start new deactivate
			$generate_customer_email = get_option( 'generate_customer_email' );
			
			$email_status = get_option( 'generate_customer_email_status', '' );
			if ( 'valid' !== $email_status )
				return;
			
			global $wp_version;
			
				// First, let's find the products associated with the email
				$response = wp_remote_post(
					'http://generatepress.com/api/licenses/check-email.php',
					array(
						'body' => 
						array(
							'generate_action' => 'get_license',
							'email' => $generate_customer_email,
						)
					)
				);
				
				// make sure the response came back okay
				if ( is_wp_error( $response ) )
					return false;

				// Now we have our associated downloads
				$downloads = json_decode( wp_remote_retrieve_body( $response ), true );
				
				
				foreach ( $downloads as $key ) {
				
					if ( 'valid' == get_option( $key['id'] . '_status' ) ) :

						$api_params = array( 
							'edd_action' => 'deactivate_license', 
							'license' => $key['license'], 
							'item_name' => urlencode( $key['name'] ) 
						);

						$license_response = wp_remote_get( add_query_arg( $api_params, 'http://generatepress.com' ), array( 'timeout' => 60, 'sslverify' => false ) );

						if ( is_wp_error( $license_response ) )
							return false;
						

						$license_data = json_decode( wp_remote_retrieve_body( $license_response ) );
						delete_option( $key['id'] . '_status', $license_data->license );
						delete_option( $key['id'], $license_data->license );
						
					endif;

				}

				delete_option( 'generate_customer_email_status' );
				
				
		}
	}
endif;

/***********************************************
* Activate all addons
* This will activate all license keys
* This will increase the site count
***********************************************/
if ( !function_exists( 'generate_activate_all' ) ) :
	add_action('admin_init', 'generate_activate_all');
	function generate_activate_all() {

		// listen for our activate button to be clicked
		if( isset( $_POST['generate_activate_all'] ) ) {

			// run a quick security check 
			if( ! check_admin_referer( 'generate_activate_all_nonce', 'generate_activate_all_nonce' ) ) 	
				return; // get out if we didn't click the Activate button
			
			// Start new deactivate
			$generate_customer_email = get_option( 'generate_customer_email' );
			
			$email_status = get_option( 'generate_customer_email_status', '' );
			if ( 'valid' !== $email_status )
				return;
			
			global $wp_version;
			
				// First, let's find the products associated with the email
				$response = wp_remote_post(
					'http://generatepress.com/api/licenses/check-email.php',
					array(
						'body' => 
						array(
							'generate_action' => 'get_license',
							'email' => $generate_customer_email,
						)
					)
				);
				
				// make sure the response came back okay
				if ( is_wp_error( $response ) )
					return false;

				// Now we have our associated downloads
				$downloads = json_decode( wp_remote_retrieve_body( $response ), true );
				
				
				foreach ( $downloads as $key ) {
				
					if ( 'valid' !== get_option( $key['id'] . '_status' ) ) :

						$api_params = array( 
							'edd_action' => 'activate_license', 
							'license' => $key['license'], 
							'item_name' => urlencode( $key['name'] ) 
						);

						$license_response = wp_remote_get( add_query_arg( $api_params, 'http://generatepress.com' ), array( 'timeout' => 60, 'sslverify' => false ) );

						if ( is_wp_error( $license_response ) )
							return false;
						

						$license_data = json_decode( wp_remote_retrieve_body( $license_response ) );
						update_option( $key['id'] . '_status', $license_data->license );
						update_option( $key['id'], $key['license'] );
						
					endif;

				}				
		}
	}
endif;

/***********************************************
* Create the option to run the cron every 3 days
***********************************************/
if ( ! function_exists( 'generate_addon_add_3day_cron_schedule' ) ):
	add_filter( 'cron_schedules', 'generate_addon_add_3day_cron_schedule' );
	function generate_addon_add_3day_cron_schedule( $schedules ) {
		$schedules['3days'] = array(
			'interval' => 259200, // 3 days in seconds
			'display'  => __( 'Once Every 3 Days', 'generate' ),
		);
	 
		return $schedules;
	}
endif;
 
// Schedule an action if it's not already scheduled
if ( ! wp_next_scheduled( 'generate_addons_check_status_action' ) ) {
    wp_schedule_event( time(), '3days', 'generate_addons_check_status_action' );
}

/***********************************************
* Check if addons are still valid every 3 days
* Will turn them off if license key is disabled
***********************************************/
if ( !function_exists( 'generate_check_all_addons' ) ) :
	add_action( 'generate_addons_check_status_action', 'generate_check_all_addons' );
	function generate_check_all_addons() {
		// Start new deactivate
		$generate_customer_email = get_option( 'generate_customer_email' );
		
		$email_status = get_option( 'generate_customer_email_status', '' );
			if ( 'valid' !== $email_status )
				return;
			
		global $wp_version;
		
			// First, let's find the products associated with the email
			$response = wp_remote_post(
				'http://generatepress.com/api/licenses/check-email.php',
				array(
					'body' => 
					array(
						'generate_action' => 'get_license',
						'email' => $generate_customer_email,
					)
				)
			);
				
			// make sure the response came back okay
			if ( is_wp_error( $response ) )
				return false;
				
			// Now we have our associated downloads
			$downloads = json_decode( wp_remote_retrieve_body( $response ), true );
				
			foreach ( $downloads as $key ) {
				
				if ( 'valid' == get_option( $key['id'] . '_status' ) ) :

					$api_params = array( 
						'edd_action' => 'check_license', 
						'license' => $key['license'], 
						'item_name' => urlencode( $key['name'] ) 
					);

					$license_response = wp_remote_get( add_query_arg( $api_params, 'http://generatepress.com' ), array( 'timeout' => 60, 'sslverify' => false ) );
					
					if ( is_wp_error( $license_response ) )
						return false;
						

					$license_data = json_decode( wp_remote_retrieve_body( $license_response ) );
					update_option( $key['id'] . '_status', $license_data->license );
					update_option( $key['id'], $key['license'] );
						
				endif;

			}

	}
endif;