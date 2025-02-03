<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250201174320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appel (id INT AUTO_INCREMENT NOT NULL, specialist_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_130D3BD7B100C1A (specialist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appel ADD CONSTRAINT FK_130D3BD7B100C1A FOREIGN KEY (specialist_id) REFERENCES specialist (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appel DROP FOREIGN KEY FK_130D3BD7B100C1A');
        $this->addSql('DROP TABLE appel');
    }
}
