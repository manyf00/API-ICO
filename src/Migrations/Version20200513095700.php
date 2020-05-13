<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513095700 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pregunta (id INT AUTO_INCREMENT NOT NULL, fecha DATE DEFAULT NULL, pregunta VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicacion (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) DEFAULT NULL, compuesto_activo VARCHAR(255) DEFAULT NULL, comprimidos_totales INT DEFAULT NULL, usos_diarios INT DEFAULT NULL, dosis INT DEFAULT NULL, observaciones VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cita (id INT AUTO_INCREMENT NOT NULL, hospital_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, fecha DATE DEFAULT NULL, edificio VARCHAR(255) DEFAULT NULL, box VARCHAR(255) DEFAULT NULL, indicaciones VARCHAR(255) DEFAULT NULL, estado TINYINT(1) DEFAULT NULL, INDEX IDX_3E379A6263DBB69 (hospital_id), UNIQUE INDEX UNIQ_3E379A62DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hospital (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) DEFAULT NULL, nombre_unidad VARCHAR(255) DEFAULT NULL, telefonos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', dias_abiertos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', hora_inicio TIME DEFAULT NULL, hora_final TIME DEFAULT NULL, correos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ubicacion JSON DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE respuesta (id INT AUTO_INCREMENT NOT NULL, fecha DATE DEFAULT NULL, texto VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuarios (id INT AUTO_INCREMENT NOT NULL, hospital_id INT DEFAULT NULL, nombre VARCHAR(255) DEFAULT NULL, apellidos VARCHAR(255) DEFAULT NULL, genero VARCHAR(255) DEFAULT NULL, correo VARCHAR(255) DEFAULT NULL, telefonos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_EF687F263DBB69 (hospital_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A6263DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id)');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A62DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE usuarios ADD CONSTRAINT FK_EF687F263DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A6263DBB69');
        $this->addSql('ALTER TABLE usuarios DROP FOREIGN KEY FK_EF687F263DBB69');
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A62DB38439E');
        $this->addSql('DROP TABLE pregunta');
        $this->addSql('DROP TABLE medicacion');
        $this->addSql('DROP TABLE cita');
        $this->addSql('DROP TABLE hospital');
        $this->addSql('DROP TABLE respuesta');
        $this->addSql('DROP TABLE usuarios');
    }
}
