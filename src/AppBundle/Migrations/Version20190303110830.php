<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\Utils;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190303110830 extends AbstractMigration
{
    const TABLE_OLD = 'facilities';
    const TABLE_NEW = 'room_facilities';

    const FULL_PATH = __DIR__.'/tmp.txt';

    public function getDescription(): string
    {
        return 'alter_' . self::TABLE_NEW . '_table';
    }

    /**
     * @param Schema $schema
     * @throws \Exception
     */
    public function up(Schema $schema) : void
    {
        Utils::addFKWithRenameTableWithFK(
            $schema,
            self::TABLE_NEW,
            self::FULL_PATH
        );
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema) : void
    {
        Utils::renameTableWithFK(
            $schema,
            self::TABLE_NEW,
            self::TABLE_OLD,
            self::FULL_PATH
        );
    }
}
