<?php

/**
 * This is a file used to store some assistant functions that will be used globally in the project
 * Add functions wisely!
 **/

/**
 * replace the space with -
 * @return string
 */
function NametoSlug($name)
{
    return str_replace(' ', '-', $name);
}

/**
 * convert the item in array into integer
 * @return array
 */
function array_intval($array)
{
    return array_map(function ($item) {
        return intval($item);
    }, $array);
}

/**
 * determine if the option is selected
 * @return bool
 */
function is_selected($var1,$var2)
{
    return $var1===$var2?'selected':'';
}
