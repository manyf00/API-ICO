<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200519153835 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hospital CHANGE telefonos telefonos JSON DEFAULT NULL, CHANGE dias_abiertos dias_abiertos JSON DEFAULT NULL, CHANGE correos correos JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE usuarios ADD data_neixement DATE DEFAULT NULL, CHANGE telefonos telefonos JSON DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hospital CHANGE telefonos telefonos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE dias_abiertos dias_abiertos LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', CHANGE correos correos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE usuarios DROP data_neixement, CHANGE telefonos telefonos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }
}
