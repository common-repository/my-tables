<?php

final class my_tables
{
    private $whoami = null;

    public function __construct()
    {
    }

    public function init($whoami = '/tmp/plugin-name/plugin-name.php')
    {
        /**
         * Put a menu in bar
         */
        add_action('admin_menu', array($this, 'my_tables_list'));

        /**
         * Adds a link within list of plugins
         */
        $this->whoami = $whoami;
        add_filter("plugin_action_links_{$this->whoami}", array($this, 'my_tables_settings_link'));
    }

    /**
     * Main page to display contents
     */
    public function my_tables_list_show()
    {
        require_once(__MY_TABLES__ . '/pages/help.php');
    }

    public function my_tables_list()
    {
        $icon = 'dashicons-info';
        add_menu_page('My Tables', 'My Tables', 'manage_options', 'my-tables/my-tables.php', array($this, 'my_tables_list_show'), $icon, 80);
        wp_enqueue_style('my-tables', plugins_url('pages/css/style.css', dirname(__FILE__)));
    }

    public function my_tables_settings_link($links)
    {
        $actions = array(
            "<a href='?page={$this->whoami}'>My Tables</a>",
            "<a href='http://bimal.org.np/wp-plugins/feedback/?plugin=my-tables'>Feedback</a>",
        );
        $links = array_merge($actions, $links);
        return $links;
    }
}
