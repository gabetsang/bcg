<?php

class Console
{
    public static function getCommandLineInput()
    {
        if (PHP_OS == 'WINNT') {
            return stream_get_line(STDIN, 1024, PHP_EOL);
        } else {
            return readline();
        }
    }
}