<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220528005801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE some_big_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, option_id INTEGER DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , description VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_9D5836B2A76ED395 ON some_big_entity (user_id)');
        $this->addSql('CREATE INDEX IDX_9D5836B2A7C41D6F ON some_big_entity (option_id)');
        $this->addSql('CREATE TABLE some_big_entity_some_m2_mentity (some_big_entity_id INTEGER NOT NULL, some_m2_mentity_id INTEGER NOT NULL, PRIMARY KEY(some_big_entity_id, some_m2_mentity_id))');
        $this->addSql('CREATE INDEX IDX_B5067844C37A760 ON some_big_entity_some_m2_mentity (some_big_entity_id)');
        $this->addSql('CREATE INDEX IDX_B506784D801740B ON some_big_entity_some_m2_mentity (some_m2_mentity_id)');
        $this->addSql('CREATE TABLE some_m2_mentity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE some_option (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_27552A82C54C8C93 ON some_option (type_id)');
        $this->addSql('CREATE TABLE some_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE some_big_entity');
        $this->addSql('DROP TABLE some_big_entity_some_m2_mentity');
        $this->addSql('DROP TABLE some_m2_mentity');
        $this->addSql('DROP TABLE some_option');
        $this->addSql('DROP TABLE some_type');
        $this->addSql('DROP TABLE user');
    }
}
