<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190302232523 extends AbstractMigration
{
    const TABLE = 'rooms_image';
    const FOREIGN_KEY = 'room_uuid_fk';

    public function getDescription(): string
    {
        return 'create_room_images_table';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable(self::TABLE);

        $table->addColumn('id', Type::INTEGER, [
            'unsigned' => true,
            'autoincrement' => true
        ]);
        $table->addColumn('filename', Type::STRING);
        $table->addColumn('room_uuid', Type::GUID);

        $table->setPrimaryKey(['id']);
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
