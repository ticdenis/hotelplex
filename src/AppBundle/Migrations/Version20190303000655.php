<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190303000655 extends AbstractMigration
{
    const TABLE = 'facilities';
    const FOREIGN_KEY = 'room_uuid_facilities_fk';

    public function getDescription() : string
    {
        return 'create_facilities_table';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable(self::TABLE);

        $table->addColumn('uuid', Type::GUID);
        $table->addColumn('room_uuid', Type::GUID);
        $table->addColumn('tv', Type::BOOLEAN);
        $table->addColumn('heating', Type::BOOLEAN);
        $table->addColumn('air_conditioning', Type::BOOLEAN);
        $table->addColumn('wc', Type::BOOLEAN);
        $table->addColumn('shower', Type::BOOLEAN);
        $table->addColumn('wardrobe', Type::BOOLEAN);
        $table->addColumn('locker', Type::BOOLEAN);
        $table->addColumn('accessibility', Type::BOOLEAN);

        $table->setPrimaryKey(['uuid']);
        $table->addForeignKeyConstraint(
            Version20190302231317::TABLE,
            ['room_uuid'],
            ['uuid'],
            [],
            self::FOREIGN_KEY
        );
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE);
    }
}
