<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

final class Version20190202211739 extends AbstractMigration
{
    const TABLE = 'payment_methods';

    public function getDescription(): string
    {
        return 'create_payment_methods_table';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable(self::TABLE);

        $table->addColumn('id', Type::SMALLINT, [
            'unsigned' => true,
            'autoincrement' => true
        ]);
        $table->addColumn('name', Type::STRING);


        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['name']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE);
    }
}
