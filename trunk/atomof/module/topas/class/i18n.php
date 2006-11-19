<?php

/** Topas */
/* Minimal i18n support */
/* stolen from merlin framework */

class Topas_i18n {

    var $messages=array();
    var $codepage;
    var $language;
    var $country;
    
    function Topas_i18n($lang,$modul){
        $this->load_messages($modul,$lang["language"],$lang["country"],$lang["codepage"]);
    }
    
    function load_messages($modul, $language, $country, $codepage=NULL ){
        $msg=$this->messages;
        $codepage = ($codepage ? ".$codepage" : "");
        $msg_file = "{$language}/{$country}{$codepage}.php";
        
        $messages=array();
        $modul_localization = TMF_I18N_DIR . "/$modul/{$msg_file}";
        @include_once($modul_localization );
        $msg=array_merge($msg,$messages);

        $this->messages = $msg;
        unset($messages);
    }

    /**
     * Retrieves a message.
     * @access public
     * @param string        The first level message id (default).
     * @param string        The second level message id (used only when the first level value is an array. Eg: days names).
     * @return string
     */

    function GetMsg( $first_level_id, $second_level_id = NULL )
    {
        if( $second_level_id === NULL )
        {
            return $this->messages[$first_level_id];
        }
        else
        {
            return $this->messages[$first_level_id][$second_level_id];
        }
    }

}

?>
