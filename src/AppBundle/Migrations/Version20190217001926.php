<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190217001926 extends AbstractMigration
{
    const TABLE = 'providers';

    public function getDescription(): string
    {
        return 'create_providers_table';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable(self::TABLE);

        $table->addColumn('uuid', Type::GUID);
        $table->addColumn('username', Type::STRING);
        $table->addColumn('email', Type::STRING);
        $table->addColumn('password', Type::STRING);
        $table->addColumn('created_at', Type::DATETIME);
        $table->addColumn('updated_at', Type::DATETIME);

        $table->setPrimaryKey(['uuid']);
        $table->addUniqueIndex(['username']);
        $table->addUniqueIndex(['email']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE);
    }
}
