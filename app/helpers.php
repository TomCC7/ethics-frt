<?php
/**
 * This is a file used to store some assistant functions that will be used globally in the project
 * Add functions wisely!
 **/
function NametoSlug($name)
{
    return str_replace(' ','-',$name);
}
