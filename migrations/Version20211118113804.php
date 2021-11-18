<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118113804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE miniature ADD pays_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE miniature ADD CONSTRAINT FK_4217EDC9A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_4217EDC9A6E44244 ON miniature (pays_id)');
        $this->addSql('ALTER TABLE vignette ADD pays_id INT DEFAULT NULL, ADD misajour DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE vignette ADD CONSTRAINT FK_B4B561EA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_B4B561EA6E44244 ON vignette (pays_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE miniature DROP FOREIGN KEY FK_4217EDC9A6E44244');
        $this->addSql('DROP INDEX IDX_4217EDC9A6E44244 ON miniature');
        $this->addSql('ALTER TABLE miniature DROP pays_id');
        $this->addSql('ALTER TABLE vignette DROP FOREIGN KEY FK_B4B561EA6E44244');
        $this->addSql('DROP INDEX IDX_B4B561EA6E44244 ON vignette');
        $this->addSql('ALTER TABLE vignette DROP pays_id, DROP misajour');
    }
}
