<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200820100605 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE badges (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, predefinie_id INT DEFAULT NULL, info LONGTEXT NOT NULL, quantite INT NOT NULL, prix DOUBLE PRECISION NOT NULL, etat VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_78F6539AA76ED395 (user_id), INDEX IDX_78F6539AA904BFF9 (predefinie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE badges_filigramme (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, badge_id INT NOT NULL, image_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_7EAD07CFA76ED395 (user_id), INDEX IDX_7EAD07CFF7A2C2FC (badge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE badges_finale (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, badge_id INT NOT NULL, image_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_CC5F51A5A76ED395 (user_id), INDEX IDX_CC5F51A5F7A2C2FC (badge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE badges ADD CONSTRAINT FK_78F6539AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE badges ADD CONSTRAINT FK_78F6539AA904BFF9 FOREIGN KEY (predefinie_id) REFERENCES badges_filigramme (id)');
        $this->addSql('ALTER TABLE badges_filigramme ADD CONSTRAINT FK_7EAD07CFA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE badges_filigramme ADD CONSTRAINT FK_7EAD07CFF7A2C2FC FOREIGN KEY (badge_id) REFERENCES badges (id)');
        $this->addSql('ALTER TABLE badges_finale ADD CONSTRAINT FK_CC5F51A5A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE badges_finale ADD CONSTRAINT FK_CC5F51A5F7A2C2FC FOREIGN KEY (badge_id) REFERENCES badges (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE badges_filigramme DROP FOREIGN KEY FK_7EAD07CFF7A2C2FC');
        $this->addSql('ALTER TABLE badges_finale DROP FOREIGN KEY FK_CC5F51A5F7A2C2FC');
        $this->addSql('ALTER TABLE badges DROP FOREIGN KEY FK_78F6539AA904BFF9');
        $this->addSql('DROP TABLE badges');
        $this->addSql('DROP TABLE badges_filigramme');
        $this->addSql('DROP TABLE badges_finale');
    }
}
