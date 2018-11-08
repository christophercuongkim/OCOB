<?php


class WidVis_Deactivate {

	/**
	 * @var string
	 */
	protected $textdomain;
	/**
	 * @var string
	 */
	protected $slug;
	/**
	 * @var WidVis_View
	 */
	protected $view;

	public function __construct( $textdomain, $slug, $view ) {

		$this->textdomain = $textdomain;
		$this->slug       = $slug;
		$this->view       = $view;
	}

	public function run() {
		add_action( 'admin_init', array( $this, 'widvis_non_pro_version_deactivate' ) );
	}

	public function widvis_non_pro_version_deactivate() {
		if ( is_admin() && current_user_can( 'activate_plugins' ) &&  is_plugin_active( 'widget-visibility-pro/widget-visibility-pro.php' ) ) {

			add_action( 'admin_notices', array( $this, 'deactivation_notice' ) );

			deactivate_plugins( $this->slug );

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}
		}
	}

	public function deactivation_notice(){
		$vars['textdomain'] = $this->textdomain;

		$this->view->render( 'deactivate.php', $vars );
	}
}