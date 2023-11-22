<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231122164342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidat_offre (candidat_id INT NOT NULL, offre_id INT NOT NULL, INDEX IDX_6F6BEA1D8D0EB82 (candidat_id), INDEX IDX_6F6BEA1D4CC8505A (offre_id), PRIMARY KEY(candidat_id, offre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidat_offre ADD CONSTRAINT FK_6F6BEA1D8D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidat_offre ADD CONSTRAINT FK_6F6BEA1D4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE intern_ship ADD title VARCHAR(255) NOT NULL, ADD limit_date DATE DEFAULT NULL, ADD req_skills LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD mission VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE job ADD title VARCHAR(255) NOT NULL, ADD limit_date DATE DEFAULT NULL, ADD req_skills LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD mission VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE offre ADD recruiter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F156BE243 FOREIGN KEY (recruiter_id) REFERENCES recruiter (id)');
        $this->addSql('CREATE INDEX IDX_AF86866F156BE243 ON offre (recruiter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidat_offre DROP FOREIGN KEY FK_6F6BEA1D8D0EB82');
        $this->addSql('ALTER TABLE candidat_offre DROP FOREIGN KEY FK_6F6BEA1D4CC8505A');
        $this->addSql('DROP TABLE candidat_offre');
        $this->addSql('ALTER TABLE intern_ship DROP title, DROP limit_date, DROP req_skills, DROP mission, DROP description');
        $this->addSql('ALTER TABLE job DROP title, DROP limit_date, DROP req_skills, DROP mission, DROP description');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F156BE243');
        $this->addSql('DROP INDEX IDX_AF86866F156BE243 ON offre');
        $this->addSql('ALTER TABLE offre DROP recruiter_id');
    }
}
