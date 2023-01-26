<?php

namespace App\Exceptions;

use Exception;

class UnauthorizedUserException extends Exception
{
    protected $message = 'User does not have permission to perform this action';
    protected $code = 403;

    public function render()
    {
        return response()->json('Usuário não possui permissões para performar esta ação', 403);
    }
}
