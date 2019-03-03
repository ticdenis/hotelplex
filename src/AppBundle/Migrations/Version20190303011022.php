<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Migrations\Utils;
use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\ForeignKeyConstraint;
use Doctrine\DBAL\Schema\Index;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190303011022 extends AbstractMigration
{
    const TABLE_OLD = 'facilities';
    const TABLE_NEW = 'room_facilities';
    const FULLPATH = __DIR__.'/tmp.txt';

    /** @var ForeignKeyConstraint[] */
    private $foreignKeys;

    public function getDescription(): string
    {
        return 'alter_' . self::TABLE_OLD . '_table';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema): void
    {

        Utils::renameTableWithFK(
            $schema,
            self::TABLE_OLD,
            self::TABLE_NEW,
            self::FULLPATH
        );
//        $table = $schema->getTable(self::TABLE_OLD);
//        $this->foreignKeys = $table->getForeignKeys();
//
//        $file = file_put_contents(self::FULLPATH, serialize($this->foreignKeys));
//        if (!$file) {
//            throw new \Exception('Error no write file');
//        }
//        \Lambdish\Phunctional\each(function (ForeignKeyConstraint $fk) use ($table) {
//            $table->removeForeignKey($fk->getName());
//        }, $table->getForeignKeys());
//        $schema->renameTable(self::TABLE_OLD, self::TABLE_NEW);
    }

    public function down(Schema $schema): void
    {
        $table = $schema->getTable(self::TABLE_OLD);
        $data = file_get_contents(__DIR__.'/tmp.txt');
        if (!$data) {
            throw new \Exception('Error no write file');
        }
        $this->foreignKeys = unserialize($data);
        \Lambdish\Phunctional\each(function (ForeignKeyConstraint $fk) use ($table) {
            echo $fk->getName();
            $table->addForeignKeyConstraint(
                $fk->getForeignTableName(),
                $fk->getLocalColumns(),
                $fk->getForeignColumns(),
                $fk->getOptions(),
                $fk->getName()
            );
        }, $this->foreignKeys);
        unlink(self::FULLPATH);
    }
}
