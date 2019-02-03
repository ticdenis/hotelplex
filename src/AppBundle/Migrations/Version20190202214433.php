<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

final class Version20190202214433 extends AbstractMigration
{
    const TABLE = 'hotel_payment_methods';
    const HOTEL_FOREIGN_KEY = 'hotel_uuid_fk';
    const PAYMENT_METHOD_FOREIGN_KEY = 'payment_method_id_fk';

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
            ['uuid'],
            [],
            self::HOTEL_FOREIGN_KEY
        );
        $table->addForeignKeyConstraint(
            Version20190202211739::TABLE,
            ['payment_method_id'],
            ['id'],
            [],
            self::PAYMENT_METHOD_FOREIGN_KEY
        );
    }

    public function down(Schema $schema): void
    {
        $table = $schema->getTable(self::TABLE);

        $table->removeForeignKey(self::HOTEL_FOREIGN_KEY);
        $table->removeForeignKey(self::PAYMENT_METHOD_FOREIGN_KEY);

        $schema->dropTable(self::TABLE);
    }
}
