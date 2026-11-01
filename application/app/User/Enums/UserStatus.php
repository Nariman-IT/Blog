<?php 

namespace App\User\Enums;
enum UserStatus: string
{
    case Banned = 'banned';
    case Active = 'active';
}