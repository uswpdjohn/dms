<?php

namespace App\Interfaces\Mailbox;

interface GetMailByCategoryInterface
{
    public static function execute(array $data,$category,$orderBy,$count);

}
