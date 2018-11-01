<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181030194429 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cargo (id INT AUTO_INCREMENT NOT NULL, id_cargo INT NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE direccion (id INT AUTO_INCREMENT NOT NULL, id_direccion INT NOT NULL, calle VARCHAR(255) DEFAULT NULL, piso INT DEFAULT NULL, numero INT DEFAULT NULL, oficina VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE empleado (id INT AUTO_INCREMENT NOT NULL, cargo_id INT DEFAULT NULL, direccion_id INT DEFAULT NULL, legajo INT NOT NULL, nombre VARCHAR(255) DEFAULT NULL, apellido VARCHAR(255) DEFAULT NULL, telefono_interno VARCHAR(255) DEFAULT NULL, telefono_directo VARCHAR(255) DEFAULT NULL, INDEX IDX_D9D9BF52813AC380 (cargo_id), UNIQUE INDEX UNIQ_D9D9BF52D0A7BD7 (direccion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estado_grupo_resolucion (id INT AUTO_INCREMENT NOT NULL, id_estado_grupo INT NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupo_resolucion (id INT AUTO_INCREMENT NOT NULL, estado_id INT NOT NULL, codigo INT NOT NULL, nombre VARCHAR(255) NOT NULL, nivel INT DEFAULT NULL, INDEX IDX_30F626779F5A440B (estado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, grupo_resolucion_id INT DEFAULT NULL, empleado_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, roles VARCHAR(255) NOT NULL, nivel INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649A0FF6FD8 (grupo_resolucion_id), UNIQUE INDEX UNIQ_8D93D649952BE730 (empleado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE empleado ADD CONSTRAINT FK_D9D9BF52813AC380 FOREIGN KEY (cargo_id) REFERENCES cargo (id)');
        $this->addSql('ALTER TABLE empleado ADD CONSTRAINT FK_D9D9BF52D0A7BD7 FOREIGN KEY (direccion_id) REFERENCES direccion (id)');
        $this->addSql('ALTER TABLE grupo_resolucion ADD CONSTRAINT FK_30F626779F5A440B FOREIGN KEY (estado_id) REFERENCES estado_grupo_resolucion (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A0FF6FD8 FOREIGN KEY (grupo_resolucion_id) REFERENCES grupo_resolucion (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649952BE730 FOREIGN KEY (empleado_id) REFERENCES empleado (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE empleado DROP FOREIGN KEY FK_D9D9BF52813AC380');
        $this->addSql('ALTER TABLE empleado DROP FOREIGN KEY FK_D9D9BF52D0A7BD7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649952BE730');
        $this->addSql('ALTER TABLE grupo_resolucion DROP FOREIGN KEY FK_30F626779F5A440B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A0FF6FD8');
        $this->addSql('DROP TABLE cargo');
        $this->addSql('DROP TABLE direccion');
        $this->addSql('DROP TABLE empleado');
        $this->addSql('DROP TABLE estado_grupo_resolucion');
        $this->addSql('DROP TABLE grupo_resolucion');
        $this->addSql('DROP TABLE user');
    }
}
