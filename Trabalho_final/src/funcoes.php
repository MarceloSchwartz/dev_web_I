<?php

function sanitize_input($data) {
    return filter_var(trim($data), FILTER_SANITIZE_SPECIAL_CHARS);
}

?>