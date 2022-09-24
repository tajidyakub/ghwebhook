<?php
namespace Tj\Ghwebhook;

enum LogType: string
{
    case INFO = 'INFO';
    case DEBUG = 'DEBUG';
    case ERROR = 'ERROR';
}
