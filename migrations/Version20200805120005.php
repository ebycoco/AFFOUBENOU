<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200805120005 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE affiche (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, info LONGTEXT NOT NULL, quantite INT NOT NULL, etat VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_E4314F0DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE affiche_filigrame (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, affiche_id INT NOT NULL, image_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_2C42FAEFA76ED395 (user_id), INDEX IDX_2C42FAEF48A60577 (affiche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE affiche_finale (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, affiche_id INT NOT NULL, image_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_3E87B120A76ED395 (user_id), INDEX IDX_3E87B12048A60577 (affiche_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE affiche ADD CONSTRAINT FK_E4314F0DA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE affiche_filigrame ADD CONSTRAINT FK_2C42FAEFA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE affiche_filigrame ADD CONSTRAINT FK_2C42FAEF48A60577 FOREIGN KEY (affiche_id) REFERENCES affiche (id)');
        $this->addSql('ALTER TABLE affiche_finale ADD CONSTRAINT FK_3E87B120A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE affiche_finale ADD CONSTRAINT FK_3E87B12048A60577 FOREIGN KEY (affiche_id) REFERENCES affiche (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE affiche_filigrame DROP FOREIGN KEY FK_2C42FAEF48A60577');
        $this->addSql('ALTER TABLE affiche_finale DROP FOREIGN KEY FK_3E87B12048A60577');
        $this->addSql('DROP TABLE affiche');
        $this->addSql('DROP TABLE affiche_filigrame');
        $this->addSql('DROP TABLE affiche_finale');
    }
}
