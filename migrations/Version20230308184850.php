<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308184850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingrediente (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plato_ingrediente (plato_id INT NOT NULL, ingrediente_id INT NOT NULL, INDEX IDX_88611C30B0DB09EF (plato_id), INDEX IDX_88611C30769E458D (ingrediente_id), PRIMARY KEY(plato_id, ingrediente_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plato_ingrediente ADD CONSTRAINT FK_88611C30B0DB09EF FOREIGN KEY (plato_id) REFERENCES plato (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plato_ingrediente ADD CONSTRAINT FK_88611C30769E458D FOREIGN KEY (ingrediente_id) REFERENCES ingrediente (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plato_ingrediente DROP FOREIGN KEY FK_88611C30B0DB09EF');
        $this->addSql('ALTER TABLE plato_ingrediente DROP FOREIGN KEY FK_88611C30769E458D');
        $this->addSql('DROP TABLE ingrediente');
        $this->addSql('DROP TABLE plato_ingrediente');
    }
}
