<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190224185234 extends AbstractMigration
{
    const TABLE = 'payments';

    public function getDescription(): string
    {
        return 'create_payments_table';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable(self::TABLE);

        $table->addColumn('uuid', Type::GUID);
        $table->addColumn('payment_method', Type::STRING);
        $table->addColumn('currency', Type::STRING);
        $table->addColumn('price', Type::FLOAT);
        $table->addColumn('created_at', Type::DATETIME);

        $table->setPrimaryKey(['uuid']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable(self::TABLE);
    }
}
