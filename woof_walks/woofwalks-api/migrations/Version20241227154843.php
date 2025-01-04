<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241227154843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo_entity ADD CONSTRAINT FK_5B97334081257D5D FOREIGN KEY (entity_id) REFERENCES walk (id)');
        $this->addSql('CREATE INDEX IDX_5B97334081257D5D ON photo_entity (entity_id)');
        $this->addSql('ALTER TABLE walk DROP FOREIGN KEY FK_8D917A557E9E4C8C');
        $this->addSql('DROP INDEX IDX_8D917A557E9E4C8C ON walk');
        $this->addSql('ALTER TABLE walk DROP photo_id, DROP file_path');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo_entity DROP FOREIGN KEY FK_5B97334081257D5D');
        $this->addSql('DROP INDEX IDX_5B97334081257D5D ON photo_entity');
        $this->addSql('ALTER TABLE walk ADD photo_id INT DEFAULT NULL, ADD file_path VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE walk ADD CONSTRAINT FK_8D917A557E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D917A557E9E4C8C ON walk (photo_id)');
    }
}
