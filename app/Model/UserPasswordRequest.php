<?php 

namespace Arifin\PHP\MVC\Model;

final class UserPasswordRequest
{
    public ?string $id = null;
    public ?string $oldPassword = null;
    public ?string $newPassword = null;
}
