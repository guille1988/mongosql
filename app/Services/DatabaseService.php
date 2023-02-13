<?php

namespace App\Services;
class DatabaseService
{
    public function getName(string $database): string
    {
        return match($database)
        {
            'mongodb' => 'MongoDB',
            'mysql' => 'MySQL'
        };
    }

    public function getOpposite(string $database): string
    {
        return $database == 'mysql' ?
            $this->getName('mongodb') :
            $this->getName('mysql');
    }

    public function getAllDataInfo(string $database): array
    {
        $currentDatabase = $this->getName($database);
        $oppositeDatabase = $this->getOpposite($database);
        $databaseValue = $database == 'mysql' ? 0 : 1;

        return compact(['currentDatabase', 'oppositeDatabase', 'databaseValue']);
    }
}
