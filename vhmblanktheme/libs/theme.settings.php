<?php
class vhmThemeSettings
{
	private $settings;
	private $current_tab;
	
	public function __construct()
	{
		$this->settings = get_option( "vhm_theme_settings" );
		$this->current_tab = ( isset ( $_GET['tab'] ) ) ? $_GET['tab'] : 'general' ;
		
		add_action( 'init', array(&$this, 'admin_init') );
		add_action( 'admin_menu', array(&$this, 'settings_page_init') );
		
		add_action('wp_head', array(&$this, 'custom_styles'));
	}
	
	public function admin_init() {
		
		if ( empty( $this->settings ) ) {
			$this->settings = array(
				'fonts' => '@import url(http://fonts.googleapis.com/css?family=Lato);',
				'font_body' => 'font-family: \'Lato\', sans-serif;'
			);
			add_option( 'vhm_theme_settings', $this->settings, '', 'yes' );
		}	
	}
	
	public function settings_page_init() {
		
		$settings_page = add_theme_page( __('Theme settings', basename(__DIR__)), __('Theme settings', basename(__DIR__)), 'edit_theme_options', 'theme-settings', array(&$this, 'settings_page') );
		add_action( "load-{$settings_page}", array(&$this, 'load_settings_page') ) ;
	}

	public function load_settings_page() {
		if ( $_POST["settings-submit"] == 'Y' ) {
			check_admin_referer( "settings-page" );
			$this->save_theme_settings();
			wp_redirect(admin_url('themes.php?page=theme-settings&tab=' . $this->current_tab . '&updated=true'));
			exit;
		}
	}

	public function save_theme_settings() {
		global $pagenow;
		
		if ( $pagenow == 'themes.php' && $_GET['page'] == 'theme-settings' ){ 
			
			switch ( $this->current_tab )
			{ 
				case 'general':
					$this->settings['fonts'] = stripslashes($_POST['fonts']);
					$this->settings['font_site_title'] = stripslashes($_POST['font_site_title']);
					$this->settings['font_site_description'] = stripslashes($_POST['font_site_description']);
					$this->settings['font_body'] = stripslashes($_POST['font_body']);
					$this->settings['font_h1'] = stripslashes($_POST['font_h1']);
					$this->settings['font_h2'] = stripslashes($_POST['font_h2']);
					$this->settings['font_h3'] = stripslashes($_POST['font_h3']);
				break; 
				case 'home': 
				break;
			}
		}
		
		if( !current_user_can( 'unfiltered_html' ) ){
			if ( $this->settings['ga']  )
				$this->settings['ga'] = stripslashes( esc_textarea( wp_filter_post_kses( $this->settings['ga'] ) ) );
			if ( $this->settings['intro'] )
				$this->settings['intro'] = stripslashes( esc_textarea( wp_filter_post_kses( $this->settings['intro'] ) ) );
		}

		$updated = update_option( "vhm_theme_settings", $this->settings );
	}

	public function admin_tabs() { 
		$tabs = array( 'general' => __('General', basename(__DIR__)) ); 
		$links = array();
		echo '<h2 class="nav-tab-wrapper">';
		foreach( $tabs as $tab => $name ){
			$class = ( $tab == $this->current_tab ) ? ' nav-tab-active' : '';
			echo "<a class='nav-tab$class' href='?page=theme-settings&tab=$tab'>$name</a>";
		}
		echo '</h2>';
	}

	public function settings_page() {
		global $pagenow;
		?>
		
		<div class="wrap">
			<h2><?php _e('Theme settings', basename(__DIR__)); ?></h2>
			
			<?php
				if ( 'true' == esc_attr( $_GET['updated'] ) ) echo '<div class="updated" ><p>Theme Settings updated.</p></div>';
				
				$this->admin_tabs($this->current_tab);
			?>

			<form method="post" action="<?php admin_url( 'themes.php?page=theme-settings' ); ?>">
				<?php
				wp_nonce_field( "settings-page" ); 
				
				if ( $pagenow == 'themes.php' && $_GET['page'] == 'theme-settings' )
				{
					if ( $this->current_tab == 'general')
					{
						?>
						<h3 class="title"><?php _e('Background color and image', basename(__DIR__)); ?></h3>
						<p><?php 
							printf(
								__('To change the background color and/or image go to %s or click the button below', basename(__DIR__)), 
								'<code>"Appearance > Background"</code>'
							); 
						?></p>
						<p><a href="<?php echo sprintf(admin_url('customize.php?return=%s&autofocus[control]=background_image'), admin_url('themes.php?page=theme-settings&tab='.$_GET['tab']) );  ?>" class="button"><?php _e('Change background')?></a></p>
						
						<h3 class="title"><?php _e('Fonts', basename(__DIR__)); ?></h3>
						<table class="form-table">
							<tr>
								<th><label for="fonts">Google Fonts</label></th>
								<td>
									<p><label for="fonts"><?php _e('Paste here the codes name from Google Fonts', basename(__DIR__))?></label></p>
									<p><textarea id="fonts" class="large-text code" name="fonts" cols="50" rows="10"><?php echo esc_html( stripslashes( $this->settings["fonts"] ) ); ?></textarea></p>
								</td>
							</tr>
							<tr>
								<th><label>Site Title Font</label></th>
								<td>
									<input type="text" id="font_site_title" class="regular-text" name="font_site_title" value="<?php echo esc_html( stripslashes( $this->settings["font_site_title"] ) ); ?>" placeholder="Site title">
								</td>
							</tr>
							<tr>
								<th><label>Site Description Font</label></th>
								<td>
									<input type="text" id="font_site_description" class="regular-text" name="font_site_description" value="<?php echo esc_html( stripslashes( $this->settings["font_site_description"] ) ); ?>" placeholder="Site description">
								</td>
							</tr>
							<tr>
								<th><label>Paragraphs</label></th>
								<td>
									<input type="text" id="font_body" class="regular-text" name="font_body" value="<?php echo esc_html( stripslashes( $this->settings["font_body"] ) ); ?>" placeholder="Paragraph">
								</td>
							</tr>
							<tr>
								<th><label>Headings 1</label></th>
								<td>
									<input type="text" id="font_h1" class="regular-text" name="font_h1" value="<?php echo esc_html( stripslashes( $this->settings["font_h1"] ) ); ?>" placeholder="Heading 1">
								</td>
							</tr>
							<tr>
								<th><label>Headings 2</th>
								<td>
									<input type="text" id="font_h2" class="regular-text" name="font_h2" value="<?php echo esc_html( stripslashes( $this->settings["font_h2"] ) ); ?>" placeholder="Heading 2">
								</td>
							</tr>
							<tr>
								<th><label>Headings 3</label></th> 
								<td>
									<input type="text" id="font_h3" class="regular-text" name="font_h3" value="<?php echo esc_html( stripslashes( $this->settings["font_h3"] ) ); ?>" placeholder="Heading 3">
								</td>
							</tr>
						</table>	
				<?php } ?>
				
			<?php } ?>
					
				<p class="submit" style="clear: both;">
					<input type="submit" name="Submit" class="button-primary" value="<?php _e('Update Settings', basename(__DIR__))?>" />
					<input type="hidden" name="settings-submit" value="Y" />
				</p>
			</form>
				
			<p class="description"><?php _e('Theme by', basename(__DIR__)); ?> <a href="http://viktormorales.com/">viktormorales.com</a> | <?php _e('Need support? Don\'t waste your precious time, HIRE ME!', basename(__DIR__)); ?> | <?php _e('Feeling generous? Buy me a beer, beer is good for motivation.', basename(__DIR__))?></p>

		</div>
	<?php
	}
	
	public function custom_styles()
	{
		?>
		<style type="text/css">
		<?php echo $this->settings['fonts']; ?>
		body { <?php echo $this->settings['font_body']; ?> }
		h1 { <?php echo $this->settings['font_h1']; ?> }
		h2 { <?php echo $this->settings['font_h2']; ?> }
		h3 { <?php echo $this->settings['font_h3']; ?> }
		.navbar-brand { <?php echo $this->settings['font_site_title']; ?> }
		</style>
		<?php
	}
}
$vhmThemeSettings = new vhmThemeSettings;