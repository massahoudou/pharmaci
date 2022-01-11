<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220111093135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE conseil ADD slug VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE maladienutrition ADD slug VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP slug');
        $this->addSql('ALTER TABLE conseil DROP slug');
        $this->addSql('ALTER TABLE maladienutrition DROP slug');
    }
}
