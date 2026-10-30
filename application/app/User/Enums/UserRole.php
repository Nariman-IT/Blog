<?php 

namespace App\User\Enums;
enum UserRole: string
{
    case Admin = 'admin';
    case User = 'user';
    case Author = 'author';
}