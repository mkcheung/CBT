<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170725050554 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE api_user_id_seq CASCADE');
        $this->addSql('CREATE TABLE arrow_down (arrow_down_id SERIAL NOT NULL, cognitive_analysis_id INT DEFAULT NULL, drillDown TEXT NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modifiedAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(arrow_down_id))');
        $this->addSql('CREATE INDEX IDX_1AE6CCEA5ECFF02 ON arrow_down (cognitive_analysis_id)');
        $this->addSql('CREATE TABLE cognitive_analysis (cognitive_analysis_id SERIAL NOT NULL, user_id INT DEFAULT NULL, trigger VARCHAR(255) NOT NULL, thoughts TEXT NOT NULL, reactions TEXT NOT NULL, alternative_perspectives TEXT NOT NULL, createdAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modifiedAt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(cognitive_analysis_id))');
        $this->addSql('CREATE INDEX IDX_B05A6758A76ED395 ON cognitive_analysis (user_id)');
        $this->addSql('ALTER TABLE arrow_down ADD CONSTRAINT FK_1AE6CCEA5ECFF02 FOREIGN KEY (cognitive_analysis_id) REFERENCES cognitive_analysis (cognitive_analysis_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cognitive_analysis ADD CONSTRAINT FK_B05A6758A76ED395 FOREIGN KEY (user_id) REFERENCES apiuser (user_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE arrow_down DROP CONSTRAINT FK_1AE6CCEA5ECFF02');
        $this->addSql('CREATE SEQUENCE api_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP TABLE arrow_down');
        $this->addSql('DROP TABLE cognitive_analysis');
    }
}
