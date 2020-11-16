<?php
if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        if (($valueLength = strlen($value)) > 1 && $value[0] === '"' && $value[$valueLength - 1] === '"') {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (! function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed  $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}



if (!function_exists('get_random_string'))
{
    /**
     * 获取随机字符串
     * @author Sean Lau <email@email.com>
     * 
     * @param integer $length
     * @param string $chars
     * @return void
     */
    function get_random_string($length = 4, $chars = "abcdefghijkmnpqrstuvwxyz23456789")
    {
        $str ="";
        for ( $i = 0; $i < $length; $i++ )  {
            $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }
}


if (!function_exists('build_ayg_query_string'))
{
    /**
     * 签名参数组装
     *
     * @param array $params 参数
     * @param boolean $isSubset 是否子集
     * @return void
     */
    function build_ayg_query_string($params, $isSubset = false)
    {
        $data = [];
        ksort($params, SORT_NATURAL);
        $isAssocArray = true;
        $count = 0;
        foreach ($params as $key => $value) {
            //判断是否顺序数组
            if ($isAssocArray) {
                if ($count != $key) {
                    $isAssocArray = false;
                }
                $count++;
            }
            if ($value === null) {
                continue;
            }

            if (is_array($value)) {
                $value = build_ayg_query_string($value, true);
            }
            $data[$key] = urldecode($value);
        }
        if ($isSubset) {
            //子集按数组和键值对不同形式组装
            if ($isAssocArray) {
                return '[' . implode(',', $data) . ']';
            } else {
                return '{' . http_build_query($data) . '}';
            }
        } else {
            return http_build_query($data);
        }
    }
}