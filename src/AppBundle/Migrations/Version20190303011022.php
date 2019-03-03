<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\Utils;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190303011022 extends AbstractMigration
{
    const TABLE_OLD = 'facilities';
    const TABLE_NEW = 'room_facilities';
    const FULL_PATH = __DIR__.'/tmp.txt';

    public function getDescription(): string
    {
        return 'alter_' . self::TABLE_OLD . '_table';
    }

    /**
     * @param Schema $schema
     * @throws SchemaException
     */
    public function up(Schema $schema): void
    {
        Utils::renameTableWithFK(
            $schema,
            self::TABLE_OLD,
            self::TABLE_NEW,
            self::FULL_PATH
        );
    }

    /**
     * @param Schema $schema
     * @throws \Exception
     */
    public function down(Schema $schema): void
    {
        Utils::addFKWithRenameTableWithFK(
          $schema,
          self::TABLE_OLD,
          self::FULL_PATH
        );
    }
}
