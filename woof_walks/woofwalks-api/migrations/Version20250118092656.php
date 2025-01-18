<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250118092656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        if ($schema->hasTable('walk')) {
            $this->addSql('DROP TABLE walk');
        }
        
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ad (id INT AUTO_INCREMENT NOT NULL, photo_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_77E0ED587E9E4C8C (photo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE walk (id INT NOT NULL, date DATE NOT NULL, time TIME NOT NULL, max_participants INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

    }

    public function down(Schema $schema): void
    {
        if ($schema->hasTable('walk')) {
            $this->addSql('DROP TABLE walk');
        }
        
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED587E9E4C8C');
        $this->addSql('ALTER TABLE walk DROP FOREIGN KEY FK_8D917A55BF396750');
        $this->addSql('DROP TABLE ad');
        $this->addSql('DROP TABLE walk');
   
    }
}
