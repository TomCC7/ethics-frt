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
    return str_replace(' ', '-', $name) . "-" . time(); // add time to guarantee uniqueness
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
 * @return string
 */
function is_selected($var1, $var2)
{
    return $var1 === $var2 ? 'selected' : '';
}

/**
 * determine if the option is selected
 * @return string
 */
function is_checked($var1, $var2)
{
    if (is_array($var2)) {
        return in_array($var1, $var2) ? 'checked' : '';
    } else {
        return $var1 === $var2 ? 'checked' : '';
    }
}
