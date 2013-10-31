<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class PC_Exceptions extends CI_Exceptions
{
    public function __construct() {
        parent::__construct();
    }

    //overide the base show_error functions
    function show_error($heading, $message, $template = 'error_general', $status_code = 500){
        set_status_header($status_code);

        $message = '<p>'.implode('</p><p>', ( ! is_array($message)) ? array($message) : $message).'</p>';

        if (ob_get_level() > $this->ob_level + 1){
            ob_end_flush();
        }

        if (defined('ENVIRONMENT')){
            switch (ENVIRONMENT){
                case 'development':
                    $template = APPPATH.'errors/'.$template.'.php';
                break;

                case 'production':
                    $template = APPPATH.'views/error.php';
                break;

                default:
                    exit('The application environment is not set correctly.');
            }
        }

        ob_start();
        include($template);
        $buffer = ob_get_contents();
        ob_end_clean();

        return $buffer;
    }

}