<?php

if (!function_exists('hello')) {
    /**
     * Criar um hash para os os css e js baseado na tag do git
     * @param $path
     * @param null $secure
     * @return string
     */
    function vAsset($path, $secure = null)
    {
        return asset($path, $secure = null) . '?v=' . shell_exec('git describe --tags');
    }
}