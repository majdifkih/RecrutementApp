<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231122202137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intern_ship DROP title, DROP limit_date, DROP req_skills, DROP mission, DROP description, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE intern_ship ADD CONSTRAINT FK_924AD29EBF396750 FOREIGN KEY (id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job DROP title, DROP limit_date, DROP req_skills, DROP mission, DROP description, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8BF396750 FOREIGN KEY (id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre ADD Offre_Type VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intern_ship DROP FOREIGN KEY FK_924AD29EBF396750');
        $this->addSql('ALTER TABLE intern_ship ADD title VARCHAR(255) NOT NULL, ADD limit_date DATE DEFAULT NULL, ADD req_skills LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD mission VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8BF396750');
        $this->addSql('ALTER TABLE job ADD title VARCHAR(255) NOT NULL, ADD limit_date DATE DEFAULT NULL, ADD req_skills LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD mission VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE offre DROP Offre_Type');
    }
}
