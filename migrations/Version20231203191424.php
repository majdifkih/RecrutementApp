<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231203191424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidat (id INT NOT NULL, birth_date DATE DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, phone_number INT DEFAULT NULL, skills LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', cv VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidat_offre (candidat_id INT NOT NULL, offre_id INT NOT NULL, INDEX IDX_6F6BEA1D8D0EB82 (candidat_id), INDEX IDX_6F6BEA1D4CC8505A (offre_id), PRIMARY KEY(candidat_id, offre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE intern_ship (id INT NOT NULL, payed TINYINT(1) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT NOT NULL, salary_prop DOUBLE PRECISION NOT NULL, contract_type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, recruiter_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, limit_date DATE DEFAULT NULL, req_skills LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', mission VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, Offre_Type VARCHAR(255) NOT NULL, INDEX IDX_AF86866F156BE243 (recruiter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recruiter (id INT NOT NULL, company_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, dtype VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471BF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidat_offre ADD CONSTRAINT FK_6F6BEA1D8D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidat_offre ADD CONSTRAINT FK_6F6BEA1D4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intern_ship ADD CONSTRAINT FK_924AD29EBF396750 FOREIGN KEY (id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8BF396750 FOREIGN KEY (id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F156BE243 FOREIGN KEY (recruiter_id) REFERENCES recruiter (id)');
        $this->addSql('ALTER TABLE recruiter ADD CONSTRAINT FK_DE8633D8BF396750 FOREIGN KEY (id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471BF396750');
        $this->addSql('ALTER TABLE candidat_offre DROP FOREIGN KEY FK_6F6BEA1D8D0EB82');
        $this->addSql('ALTER TABLE candidat_offre DROP FOREIGN KEY FK_6F6BEA1D4CC8505A');
        $this->addSql('ALTER TABLE intern_ship DROP FOREIGN KEY FK_924AD29EBF396750');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8BF396750');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F156BE243');
        $this->addSql('ALTER TABLE recruiter DROP FOREIGN KEY FK_DE8633D8BF396750');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE candidat_offre');
        $this->addSql('DROP TABLE intern_ship');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE recruiter');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
