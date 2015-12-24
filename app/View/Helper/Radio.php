<?php
// app/views/helpers/radio.php
class RadioHelper extends AppHelper {

    function display($id, $options = array()) {
        if (isset($options['options']) && !empty($options['options'])) {
            $rc = "";
            foreach ($options['options'] as $option) {
                $rc .= "<label>";
                $rc .= "<input ....>";
                $rc .= "</label>";
            }
            return($rc);
        }
        return(false); // No options supplied.
    }
}

?>