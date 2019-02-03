<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

final class Version20190202212623 extends AbstractMigration
{
    const TABLE = 'hotels';

    public function getDescription(): string
    {
        return 'create_hotels_table';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable(self::TABLE);

        $table->addColumn('uuid', Type::GUID);
        $table->addColumn('name', Type::STRING);
        $table->addColumn('address', Type::STRING);
        $table->addColumn('phone', Type::STRING);
        $table->addColumn('email', Type::STRING);
        $table->addColumn('lift', Type::BOOLEAN);
        $table->addColumn('wifi', Type::BOOLEAN);
        $table->addColumn('accessibility', Type::BOOLEAN);
        $table->addColumn('parking', Type::BOOLEAN);
        $table->addColumn('kitchen', Type::BOOLEAN);
        $table->addColumn('pets', Type::BOOLEAN);
        $table->addColumn('logo', Type::STRING, [
            'notnull' => false
        ]);
        $table->addColumn('created_at', Type::DATETIME);
        $table->addColumn('updated_at', Type::DATETIME);

        $table->setPrimaryKey(['uuid']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE);
    }
}
