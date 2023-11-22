<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231122163055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidat (id INT NOT NULL, birth_date DATE DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, phone_number INT DEFAULT NULL, skills LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', cv VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intern_ship (id INT AUTO_INCREMENT NOT NULL, payed TINYINT(1) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, salary_prop DOUBLE PRECISION NOT NULL, contract_type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, limit_date DATE DEFAULT NULL, req_skills LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', mission VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recruiter (id INT NOT NULL, company_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471BF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recruiter ADD CONSTRAINT FK_DE8633D8BF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP company_name, DROP birth_date, DROP adress, DROP phone_number, DROP skills, DROP cv');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471BF396750');
        $this->addSql('ALTER TABLE recruiter DROP FOREIGN KEY FK_DE8633D8BF396750');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE intern_ship');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE recruiter');
        $this->addSql('ALTER TABLE `user` ADD company_name VARCHAR(255) DEFAULT NULL, ADD birth_date DATE DEFAULT NULL, ADD adress VARCHAR(255) DEFAULT NULL, ADD phone_number INT DEFAULT NULL, ADD skills LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD cv VARCHAR(255) DEFAULT NULL');
    }
}
