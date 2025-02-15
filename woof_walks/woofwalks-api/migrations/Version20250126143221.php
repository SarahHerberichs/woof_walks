<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250126143221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE walk_user (walk_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_563B92D05EEE1B48 (walk_id), INDEX IDX_563B92D0A76ED395 (user_id), PRIMARY KEY(walk_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE walk_user ADD CONSTRAINT FK_563B92D05EEE1B48 FOREIGN KEY (walk_id) REFERENCES walk (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE walk_user ADD CONSTRAINT FK_563B92D0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE ad ADD creator_id INT NOT NULL');
        // $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED5861220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        // $this->addSql('CREATE INDEX IDX_77E0ED5861220EA6 ON ad (creator_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED5861220EA6');
        // $this->addSql('ALTER TABLE walk_user DROP FOREIGN KEY FK_563B92D05EEE1B48');
        // $this->addSql('ALTER TABLE walk_user DROP FOREIGN KEY FK_563B92D0A76ED395');
        // $this->addSql('DROP TABLE user');
        // $this->addSql('DROP TABLE walk_user');
        // $this->addSql('DROP INDEX IDX_77E0ED5861220EA6 ON ad');
        // $this->addSql('ALTER TABLE ad DROP creator_id');
    }
}
