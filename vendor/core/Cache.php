<?php


namespace core;


class Cache
{
    use TSingletone;

    public function set($key, $data, $seconds = 3600): bool
    {
        $content['data'] = $data;
        $content['end_time'] = time() + $seconds;
        if(file_put_contents(CACHE . '/' . md5($key) . '.txt', serialize($content))) {

        }
    }


}