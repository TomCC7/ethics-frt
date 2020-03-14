<?php
/**
 * This is a file used to store some assistant functions that will be used globally in the project
 * Add functions wisely!
 **/
use Illuminate\Support\Facades\Auth;

// should be moved to proper place
function check_admin()
{
    return Auth::user()->is_admin;
}
