<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

final class Version20190202214433 extends AbstractMigration
{
    const TABLE = 'hotel_payment_methods';

    public function getDescription(): string
    {
        return 'create_hotel_payment_methods_table';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable(self::TABLE);

        $table->addColumn('id', Type::INTEGER, [
            'unsigned' => true,
            'autoincrement' => true
        ]);
        $table->addColumn('hotel_uuid', Type::GUID);
        $table->addColumn('payment_method_id', Type::SMALLINT, [
            'unsigned' => true
        ]);

        $table->setPrimaryKey(['id']);
        $table->addForeignKeyConstraint(
            Version20190202212623::TABLE,
            ['hotel_uuid'],
            ['uuid']
        );
        $table->addForeignKeyConstraint(
            Version20190202211739::TABLE,
            ['payment_method_id'],
            ['id']
        );
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE);
    }
}
