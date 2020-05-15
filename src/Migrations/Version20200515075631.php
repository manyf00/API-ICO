<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200515075631 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pregunta (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, fecha DATE DEFAULT NULL, pregunta VARCHAR(255) DEFAULT NULL, INDEX IDX_AEE0E1F7DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicacion (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) DEFAULT NULL, compuesto_activo VARCHAR(255) DEFAULT NULL, comprimidos_totales INT DEFAULT NULL, usos_diarios INT DEFAULT NULL, dosis INT DEFAULT NULL, observaciones VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicacion_usuarios (medicacion_id INT NOT NULL, usuarios_id INT NOT NULL, INDEX IDX_EF27B88E8E34449A (medicacion_id), INDEX IDX_EF27B88EF01D3B25 (usuarios_id), PRIMARY KEY(medicacion_id, usuarios_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cita (id INT AUTO_INCREMENT NOT NULL, hospital_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, fecha DATE DEFAULT NULL, edificio VARCHAR(255) DEFAULT NULL, box VARCHAR(255) DEFAULT NULL, indicaciones VARCHAR(255) DEFAULT NULL, estado TINYINT(1) DEFAULT NULL, INDEX IDX_3E379A6263DBB69 (hospital_id), INDEX IDX_3E379A62DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hospital (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) DEFAULT NULL, nombre_unidad VARCHAR(255) DEFAULT NULL, telefonos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', dias_abiertos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', hora_inicio TIME DEFAULT NULL, hora_final TIME DEFAULT NULL, correos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ubicacion JSON DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE respuesta (id INT AUTO_INCREMENT NOT NULL, pregunta_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, fecha DATE DEFAULT NULL, texto VARCHAR(255) DEFAULT NULL, INDEX IDX_6C6EC5EE31A5801E (pregunta_id), INDEX IDX_6C6EC5EEDB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuarios (id INT AUTO_INCREMENT NOT NULL, hospital_id INT DEFAULT NULL, nombre VARCHAR(255) DEFAULT NULL, apellidos VARCHAR(255) DEFAULT NULL, genero VARCHAR(255) DEFAULT NULL, correo VARCHAR(255) DEFAULT NULL, telefonos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_EF687F263DBB69 (hospital_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pregunta ADD CONSTRAINT FK_AEE0E1F7DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE medicacion_usuarios ADD CONSTRAINT FK_EF27B88E8E34449A FOREIGN KEY (medicacion_id) REFERENCES medicacion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medicacion_usuarios ADD CONSTRAINT FK_EF27B88EF01D3B25 FOREIGN KEY (usuarios_id) REFERENCES usuarios (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A6263DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id)');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A62DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE respuesta ADD CONSTRAINT FK_6C6EC5EE31A5801E FOREIGN KEY (pregunta_id) REFERENCES pregunta (id)');
        $this->addSql('ALTER TABLE respuesta ADD CONSTRAINT FK_6C6EC5EEDB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id)');
        $this->addSql('ALTER TABLE usuarios ADD CONSTRAINT FK_EF687F263DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE respuesta DROP FOREIGN KEY FK_6C6EC5EE31A5801E');
        $this->addSql('ALTER TABLE medicacion_usuarios DROP FOREIGN KEY FK_EF27B88E8E34449A');
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A6263DBB69');
        $this->addSql('ALTER TABLE usuarios DROP FOREIGN KEY FK_EF687F263DBB69');
        $this->addSql('ALTER TABLE pregunta DROP FOREIGN KEY FK_AEE0E1F7DB38439E');
        $this->addSql('ALTER TABLE medicacion_usuarios DROP FOREIGN KEY FK_EF27B88EF01D3B25');
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A62DB38439E');
        $this->addSql('ALTER TABLE respuesta DROP FOREIGN KEY FK_6C6EC5EEDB38439E');
        $this->addSql('DROP TABLE pregunta');
        $this->addSql('DROP TABLE medicacion');
        $this->addSql('DROP TABLE medicacion_usuarios');
        $this->addSql('DROP TABLE cita');
        $this->addSql('DROP TABLE hospital');
        $this->addSql('DROP TABLE respuesta');
        $this->addSql('DROP TABLE usuarios');
    }
}
