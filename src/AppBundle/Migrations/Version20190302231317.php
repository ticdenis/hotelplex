<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190302231317 extends AbstractMigration
{
    const TABLE = 'rooms';
    const FOREIGN_KEY = 'currency_uuid_fk';

    public function getDescription() : string
    {
        return 'create_rooms_table';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable(self::TABLE);
        $table->addColumn('uuid', Type::GUID);
        $table->addColumn('currency_id', Type::INTEGER, [
            'unsigned' => true
        ]);
        $table->addColumn('individual_price', Type::FLOAT);
        $table->addColumn('individual_beds', Type::STRING);
        $table->addColumn('double_price', Type::FLOAT);
        $table->addColumn('double_beds', Type::STRING);

        $table->addForeignKeyConstraint(
            Version20190302231315::TABLE,
            ['currency_id'],
            ['id'],
            [],
            self::FOREIGN_KEY
        );

        $table->setPrimaryKey(['uuid']);
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable(self::TABLE);
    }
}
