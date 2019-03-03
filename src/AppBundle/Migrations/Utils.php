<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\ForeignKeyConstraint;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;

final class Utils
{
    /**
     * @param Schema $schema
     * @param string $oldTable
     * @param string $newTable
     * @param string $pathFile
     * @throws SchemaException
     */
    public static function renameTableWithFK(
        Schema $schema,
        string $oldTable,
        string $newTable,
        string $pathFile

    ) {
        $table = $schema->getTable($oldTable);
        $foreignKeys = $table->getForeignKeys();

        $file = file_put_contents($pathFile, serialize($foreignKeys));
        if (!$file) {
            throw new \Exception('Error get content file in: '. $pathFile);
        }
        \Lambdish\Phunctional\each(function (ForeignKeyConstraint $fk) use ($table) {
            $table->removeForeignKey($fk->getName());
        }, $foreignKeys);
        $schema->renameTable($oldTable, $newTable);
    }

}
