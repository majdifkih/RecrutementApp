<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231125120540 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471A76ED395');
        $this->addSql('DROP INDEX UNIQ_6AB5B471E7927C74 ON candidat');
        $this->addSql('DROP INDEX UNIQ_6AB5B471A76ED395 ON candidat');
        $this->addSql('ALTER TABLE candidat DROP user_id, DROP roles, DROP email, DROP password, DROP first_name, DROP last_name, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471BF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_DE8633D8E7927C74 ON recruiter');
        $this->addSql('ALTER TABLE recruiter DROP roles, DROP email, DROP password, DROP first_name, DROP last_name, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE recruiter ADD CONSTRAINT FK_DE8633D8BF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD user_type VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471BF396750');
        $this->addSql('ALTER TABLE candidat ADD user_id INT DEFAULT NULL, ADD roles JSON NOT NULL COMMENT \'(DC2Type:json)\', ADD email VARCHAR(180) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD first_name VARCHAR(255) DEFAULT NULL, ADD last_name VARCHAR(255) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6AB5B471E7927C74 ON candidat (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6AB5B471A76ED395 ON candidat (user_id)');
        $this->addSql('ALTER TABLE recruiter DROP FOREIGN KEY FK_DE8633D8BF396750');
        $this->addSql('ALTER TABLE recruiter ADD roles JSON NOT NULL COMMENT \'(DC2Type:json)\', ADD email VARCHAR(180) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD first_name VARCHAR(255) DEFAULT NULL, ADD last_name VARCHAR(255) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DE8633D8E7927C74 ON recruiter (email)');
        $this->addSql('ALTER TABLE `user` DROP user_type');
    }
}
