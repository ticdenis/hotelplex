<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190302231315 extends AbstractMigration
{
    const TABLE = 'currencies';

    public function getDescription() : string
    {
        return 'create_currencies_table';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable(self::TABLE);
        $table->addColumn('id', Type::INTEGER, [
            'unsigned' => true,
            'autoincrement' => true
        ]);
        $table->addColumn('code', Type::STRING);
        $table->addUniqueIndex(['code']);
        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable(self::TABLE);
    }
}
