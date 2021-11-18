<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118122623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pub ADD pays_id INT DEFAULT NULL, ADD position INT NOT NULL');
        $this->addSql('ALTER TABLE pub ADD CONSTRAINT FK_5A443C85A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_5A443C85A6E44244 ON pub (pays_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pub DROP FOREIGN KEY FK_5A443C85A6E44244');
        $this->addSql('DROP INDEX IDX_5A443C85A6E44244 ON pub');
        $this->addSql('ALTER TABLE pub DROP pays_id, DROP position');
    }
}
