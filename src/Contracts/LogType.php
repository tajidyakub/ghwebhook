<?php

namespace Tj\Ghwebhook\Contracts;

enum LogType: string
{
    case INFO = 'INFO';
    case DEBUG = 'DEBUG';
    case ERROR = 'ERROR';
}
