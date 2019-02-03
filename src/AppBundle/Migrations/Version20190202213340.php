<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

final class Version20190202213340 extends AbstractMigration
{
    const TABLE = 'hotels_images';
    const FOREIGN_KEY = 'hotel_uuid_fk';

    public function getDescription(): string
    {
        return 'create_hotel_images_table';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable(self::TABLE);

        $table->addColumn('id', Type::INTEGER, [
            'unsigned' => true,
            'autoincrement' => true
        ]);
        $table->addColumn('filename', Type::STRING);
        $table->addColumn('hotel_uuid', Type::GUID);

        $table->setPrimaryKey(['id']);
        $table->addForeignKeyConstraint(
            Version20190202212623::TABLE,
            ['hotel_uuid'],
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
