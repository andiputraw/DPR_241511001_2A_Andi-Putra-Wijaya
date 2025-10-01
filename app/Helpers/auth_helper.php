<?php

if(!function_exists('is_admin')) {
    function is_admin()
    {
        $session = session();
        return $session->get('isLoggedIn') && $session->get('role') === 'Admin';
    }
}

