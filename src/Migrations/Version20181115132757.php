<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181115132757 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cargo (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clasificacion_ticket (id INT AUTO_INCREMENT NOT NULL, estado_cla_id INT DEFAULT NULL, user_id INT DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, nombre VARCHAR(255) DEFAULT NULL, INDEX IDX_CCB105B02A43A2E9 (estado_cla_id), INDEX IDX_CCB105B0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE direccion (id INT AUTO_INCREMENT NOT NULL, calle VARCHAR(255) DEFAULT NULL, piso INT DEFAULT NULL, numero INT DEFAULT NULL, oficina VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE empleado (id INT AUTO_INCREMENT NOT NULL, cargo_id INT DEFAULT NULL, direccion_id INT DEFAULT NULL, legajo INT NOT NULL, nombre VARCHAR(255) DEFAULT NULL, apellido VARCHAR(255) DEFAULT NULL, telefono_interno VARCHAR(255) DEFAULT NULL, telefono_directo VARCHAR(255) DEFAULT NULL, INDEX IDX_D9D9BF52813AC380 (cargo_id), UNIQUE INDEX UNIQ_D9D9BF52D0A7BD7 (direccion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estado_clasificacion_ticket (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estado_grupo_resolucion (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estado_intervencion (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estado_ticket (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupo_resolucion (id INT AUTO_INCREMENT NOT NULL, estado_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, nivel INT DEFAULT NULL, INDEX IDX_30F626779F5A440B (estado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intervencion (id INT AUTO_INCREMENT NOT NULL, grupo_resolucion_id INT DEFAULT NULL, ticket_id INT DEFAULT NULL, observaciones VARCHAR(255) DEFAULT NULL, INDEX IDX_1CD67B8DA0FF6FD8 (grupo_resolucion_id), INDEX IDX_1CD67B8D700047D2 (ticket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_historico_clasificacion (id INT AUTO_INCREMENT NOT NULL, clasificacion_id INT DEFAULT NULL, user_id INT DEFAULT NULL, ticket_id INT DEFAULT NULL, fecha_desde DATETIME DEFAULT NULL, fecha_hasta DATETIME DEFAULT NULL, observacion VARCHAR(255) DEFAULT NULL, INDEX IDX_EDA484DA78ECAC4A (clasificacion_id), INDEX IDX_EDA484DAA76ED395 (user_id), INDEX IDX_EDA484DA700047D2 (ticket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_historico_estados (id INT AUTO_INCREMENT NOT NULL, estado_ticket_id INT DEFAULT NULL, user_id INT DEFAULT NULL, ticket_id INT DEFAULT NULL, fecha_desde DATETIME DEFAULT NULL, fecha_hasta DATETIME DEFAULT NULL, observacion VARCHAR(255) DEFAULT NULL, INDEX IDX_91D2DF8EAE4A2FA4 (estado_ticket_id), INDEX IDX_91D2DF8EA76ED395 (user_id), INDEX IDX_91D2DF8E700047D2 (ticket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_historico_intervencion (id INT AUTO_INCREMENT NOT NULL, estado_intervencion_id INT DEFAULT NULL, user_id INT DEFAULT NULL, intervencion_id INT DEFAULT NULL, fecha_desde DATETIME DEFAULT NULL, fecha_hasta DATETIME DEFAULT NULL, INDEX IDX_F0F5C50B2B50E810 (estado_intervencion_id), INDEX IDX_F0F5C50BA76ED395 (user_id), INDEX IDX_F0F5C50B2CD79A23 (intervencion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, empleado_id INT DEFAULT NULL, user_id INT DEFAULT NULL, nro_ticket INT NOT NULL, descripcion VARCHAR(255) NOT NULL, fecha DATETIME DEFAULT NULL, INDEX IDX_97A0ADA3952BE730 (empleado_id), INDEX IDX_97A0ADA3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, grupo_resolucion_id INT DEFAULT NULL, empleado_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, roles VARCHAR(255) NOT NULL, nivel INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649A0FF6FD8 (grupo_resolucion_id), UNIQUE INDEX UNIQ_8D93D649952BE730 (empleado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clasificacion_ticket ADD CONSTRAINT FK_CCB105B02A43A2E9 FOREIGN KEY (estado_cla_id) REFERENCES estado_clasificacion_ticket (id)');
        $this->addSql('ALTER TABLE clasificacion_ticket ADD CONSTRAINT FK_CCB105B0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE empleado ADD CONSTRAINT FK_D9D9BF52813AC380 FOREIGN KEY (cargo_id) REFERENCES cargo (id)');
        $this->addSql('ALTER TABLE empleado ADD CONSTRAINT FK_D9D9BF52D0A7BD7 FOREIGN KEY (direccion_id) REFERENCES direccion (id)');
        $this->addSql('ALTER TABLE grupo_resolucion ADD CONSTRAINT FK_30F626779F5A440B FOREIGN KEY (estado_id) REFERENCES estado_grupo_resolucion (id)');
        $this->addSql('ALTER TABLE intervencion ADD CONSTRAINT FK_1CD67B8DA0FF6FD8 FOREIGN KEY (grupo_resolucion_id) REFERENCES grupo_resolucion (id)');
        $this->addSql('ALTER TABLE intervencion ADD CONSTRAINT FK_1CD67B8D700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE item_historico_clasificacion ADD CONSTRAINT FK_EDA484DA78ECAC4A FOREIGN KEY (clasificacion_id) REFERENCES clasificacion_ticket (id)');
        $this->addSql('ALTER TABLE item_historico_clasificacion ADD CONSTRAINT FK_EDA484DAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item_historico_clasificacion ADD CONSTRAINT FK_EDA484DA700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE item_historico_estados ADD CONSTRAINT FK_91D2DF8EAE4A2FA4 FOREIGN KEY (estado_ticket_id) REFERENCES estado_ticket (id)');
        $this->addSql('ALTER TABLE item_historico_estados ADD CONSTRAINT FK_91D2DF8EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item_historico_estados ADD CONSTRAINT FK_91D2DF8E700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE item_historico_intervencion ADD CONSTRAINT FK_F0F5C50B2B50E810 FOREIGN KEY (estado_intervencion_id) REFERENCES estado_intervencion (id)');
        $this->addSql('ALTER TABLE item_historico_intervencion ADD CONSTRAINT FK_F0F5C50BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item_historico_intervencion ADD CONSTRAINT FK_F0F5C50B2CD79A23 FOREIGN KEY (intervencion_id) REFERENCES intervencion (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3952BE730 FOREIGN KEY (empleado_id) REFERENCES empleado (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A0FF6FD8 FOREIGN KEY (grupo_resolucion_id) REFERENCES grupo_resolucion (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649952BE730 FOREIGN KEY (empleado_id) REFERENCES empleado (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE empleado DROP FOREIGN KEY FK_D9D9BF52813AC380');
        $this->addSql('ALTER TABLE item_historico_clasificacion DROP FOREIGN KEY FK_EDA484DA78ECAC4A');
        $this->addSql('ALTER TABLE empleado DROP FOREIGN KEY FK_D9D9BF52D0A7BD7');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3952BE730');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649952BE730');
        $this->addSql('ALTER TABLE clasificacion_ticket DROP FOREIGN KEY FK_CCB105B02A43A2E9');
        $this->addSql('ALTER TABLE grupo_resolucion DROP FOREIGN KEY FK_30F626779F5A440B');
        $this->addSql('ALTER TABLE item_historico_intervencion DROP FOREIGN KEY FK_F0F5C50B2B50E810');
        $this->addSql('ALTER TABLE item_historico_estados DROP FOREIGN KEY FK_91D2DF8EAE4A2FA4');
        $this->addSql('ALTER TABLE intervencion DROP FOREIGN KEY FK_1CD67B8DA0FF6FD8');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A0FF6FD8');
        $this->addSql('ALTER TABLE item_historico_intervencion DROP FOREIGN KEY FK_F0F5C50B2CD79A23');
        $this->addSql('ALTER TABLE intervencion DROP FOREIGN KEY FK_1CD67B8D700047D2');
        $this->addSql('ALTER TABLE item_historico_clasificacion DROP FOREIGN KEY FK_EDA484DA700047D2');
        $this->addSql('ALTER TABLE item_historico_estados DROP FOREIGN KEY FK_91D2DF8E700047D2');
        $this->addSql('ALTER TABLE clasificacion_ticket DROP FOREIGN KEY FK_CCB105B0A76ED395');
        $this->addSql('ALTER TABLE item_historico_clasificacion DROP FOREIGN KEY FK_EDA484DAA76ED395');
        $this->addSql('ALTER TABLE item_historico_estados DROP FOREIGN KEY FK_91D2DF8EA76ED395');
        $this->addSql('ALTER TABLE item_historico_intervencion DROP FOREIGN KEY FK_F0F5C50BA76ED395');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3A76ED395');
        $this->addSql('DROP TABLE cargo');
        $this->addSql('DROP TABLE clasificacion_ticket');
        $this->addSql('DROP TABLE direccion');
        $this->addSql('DROP TABLE empleado');
        $this->addSql('DROP TABLE estado_clasificacion_ticket');
        $this->addSql('DROP TABLE estado_grupo_resolucion');
        $this->addSql('DROP TABLE estado_intervencion');
        $this->addSql('DROP TABLE estado_ticket');
        $this->addSql('DROP TABLE grupo_resolucion');
        $this->addSql('DROP TABLE intervencion');
        $this->addSql('DROP TABLE item_historico_clasificacion');
        $this->addSql('DROP TABLE item_historico_estados');
        $this->addSql('DROP TABLE item_historico_intervencion');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE user');
    }
}
