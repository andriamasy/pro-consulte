<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250202085043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mail ADD specialist_id INT NOT NULL');
        $this->addSql('ALTER TABLE mail ADD CONSTRAINT FK_5126AC487B100C1A FOREIGN KEY (specialist_id) REFERENCES specialist (id)');
        $this->addSql('CREATE INDEX IDX_5126AC487B100C1A ON mail (specialist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mail DROP FOREIGN KEY FK_5126AC487B100C1A');
        $this->addSql('DROP INDEX IDX_5126AC487B100C1A ON mail');
        $this->addSql('ALTER TABLE mail DROP specialist_id');
    }
}
