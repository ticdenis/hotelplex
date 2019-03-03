<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Types\Type;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190303001927 extends AbstractMigration
{
    const TABLE = 'payments';
    const FIELD = 'currency';

    public function getDescription() : string
    {
        return 'alter_payments_table';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->getTable(self::TABLE);
        $table->getColumn(self::FIELD)
            ->setType(Type::getType(Type::INTEGER))
            ->setUnsigned(true);
    }

    public function down(Schema $schema) : void
    {
        $table = $schema->getTable(self::TABLE);
        $table->getColumn(self::FIELD)
            ->setType(Type::getType(Type::STRING));
    }
}
