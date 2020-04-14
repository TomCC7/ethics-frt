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
 * @param mixed $var1,$var2
 * @param string $type
 * @return string
 */
function is_selected($var1, $var2, $type = 'selected')
{
    return $var1 === $var2 ? $type : '';
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

/**
 * get the configuration of database
 * @return array
 */
function get_db_config()
{
    if (getenv('IS_IN_HEROKU')) {
        $url = parse_url(getenv("DATABASE_URL"));

        return $db_config = [
            'connection' => 'pgsql',
            'host' => $url["host"],
            'database'  => substr($url["path"], 1),
            'username'  => $url["user"],
            'password'  => $url["pass"],
        ];
    } else {
        return $db_config = [
            'connection' => env('DB_CONNECTION', 'mysql'),
            'host' => env('DB_HOST', 'localhost'),
            'database'  => env('DB_DATABASE', 'forge'),
            'username'  => env('DB_USERNAME', 'forge'),
            'password'  => env('DB_PASSWORD', ''),
        ];
    }
}

/**
 * convert the array to object
 * @param array $array
 * @return object
 */
function array_to_object($array)
{
    return json_decode(json_encode($array));
}
