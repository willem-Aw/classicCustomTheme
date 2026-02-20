<?php
/**
 * AgencyMenuPage Class
 *
 * This class handles the creation and management of the Agency Settings page
 * in the WordPress admin dashboard. It registers settings for agency information
 * including name, address, phone number, and working hours.
 *
 * @package ClassicCustomTheme
 * @subpackage Options
 */
class AgencyMenuPage
{
    /**
     * Settings group name used for registering settings and rendering the settings page.
     * This constant is used as the page slug and option group name throughout the class.
     *
     */
    const GROUP = 'agency_settings';

    /**
     * Registers the class methods with appropriate WordPress hooks.
     *
     * This method should be called during WordPress initialization (e.g., via add_action('init', ...))
     * to set up the menu page and settings registration.
     *
     * @return void
     */
    public static function register()
    {
        add_action('admin_menu', [self::class, 'add_menu_page']);
        add_action('admin_init', [self::class, 'register_settings']);
    }

    /**
     * Registers all settings, sections, and fields for the Agency Settings page.
     *
     * This method handles:
     * - Registering 4 options: agency_name, agency_address, agency_phone, agency_hour
     * - Adding a settings section with description
     * - Adding settings fields for each option with appropriate input controls
     *
     * @return void
     */
    public static function register_settings()
    {
        // Register the agency_name setting (text input)
        register_setting(self::GROUP, 'agency_name', [
            'type' => 'string',
            'label' => 'Name',
        ]);
        
        // Register the agency_address setting (text input)
        register_setting(self::GROUP, 'agency_address',  [
            'type' => 'string',
            'label' => 'Address',
        ]);
        
        // Register the agency_phone setting (number input)
        register_setting(self::GROUP, 'agency_phone',  [
            'type' => 'number',
            'label' => 'Phone number',
        ]);
        
        // Register the agency_hour setting (textarea for working hours)
        register_setting(self::GROUP, 'agency_hour',  [
            'label' => 'Working hours',
        ]);

        // Add a settings section to group related settings together
        add_settings_section(
            'agency_main_section', // ID - unique identifier for this section
            'Main Settings', // Title - displayed as section heading
            function () {
                // Callback to render section description
                echo '<p>Configure the main settings of the agency.</p>';
            }, // Callback for description (optional)
            self::GROUP // Page slug - matches the settings page
        );

        // Add settings field for Agency Name (text input)
        add_settings_field(
            'agency_name', // ID - unique identifier for this field
            'Agency Name', // Title - displayed as field label
            function () {
                // Callback to render the input field
                $value = get_option('agency_name', '');
                echo '<input type="text" name="agency_name" value="' . esc_attr($value) . '" class="regular-text" />';
            },
            self::GROUP, // Page slug
            'agency_main_section' // Section ID
        );
        
        // Add settings field for Agency Address (text input)
        add_settings_field(
            'agency_address', // ID
            'Agency Address', // Title
            function () {
                $value = get_option('agency_address', '');
                echo '<input type="text" name="agency_address" value="' . esc_attr($value) . '" class="regular-text" />';
            }, // Callback to render the field
            self::GROUP, // Page slug
            'agency_main_section' // Section ID
        );
        
        // Add settings field for Agency Phone (text input)
        add_settings_field(
            'agency_phone', // ID
            'Agency Phone', // Title
            function () {
                $value = get_option('agency_phone', '');
                echo '<input type="text" name="agency_phone" value="' . esc_attr($value) . '" class="regular-text" />';
            }, // Callback to render the field
            self::GROUP, // Page slug
            'agency_main_section' // Section ID
        );

        // Add settings field for Agency Hours (textarea)
        add_settings_field(
            'agency_hour', // ID
            'Agency Hours', // Title
            function () {
                // Callback to render textarea for working hours
                $value = get_option('agency_hour', ''); // Get saved value or empty string
                echo '<textarea name="agency_hour" rows="5" cols="33" class="large-text">' . esc_textarea($value) . '</textarea>';
            }, // Callback to render the field
            self::GROUP, // Page slug
            'agency_main_section' // Section ID
        );
    }

    /**
     * Adds the Agency Settings page to the WordPress admin menu.
     *
     * This method adds a new submenu page under the "Settings" menu
     * in the WordPress admin dashboard.
     *
     * @return void
     */
    public static function add_menu_page()
    {
        add_options_page(
            'Agency Settings', // Page title - displayed in browser title bar
            'Agency',          // Menu title - displayed in the admin sidebar
            'manage_options',  // Capability required to access the page (administrator only)
            self::GROUP, // Menu slug - unique identifier for this page
            [self::class, 'render_settings_page'] // Callback function to render the page
        );
    }

    /**
     * Renders the Agency Settings page HTML.
     *
     * This method outputs the HTML markup for the settings page,
     * including the form with all registered settings fields.
     * The form uses WordPress settings API for secure data handling.
     *
     * @return void
     */
    public static function render_settings_page()
    {
?>
        <div class="wrap">
            <h1>Agency Settings</h1>
            <form method="post" action="options.php">
                <?php
                // Output security fields for the registered settings group
                settings_fields(self::GROUP); 
                
                // Output all settings sections and fields for this page
                do_settings_sections(self::GROUP); 
                
                // Output the submit button (Save Changes)
                submit_button();
                ?>
            </form>
        </div>
<?php
    }
}
