<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220604071121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, filename VARCHAR(255) NOT NULL)');
        $this->addSql('DROP INDEX IDX_9D5836B2A7C41D6F');
        $this->addSql('DROP INDEX IDX_9D5836B2A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__some_big_entity AS SELECT id, user_id, option_id, created_at, description FROM some_big_entity');
        $this->addSql('DROP TABLE some_big_entity');
        $this->addSql('CREATE TABLE some_big_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, option_id INTEGER DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , description VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_9D5836B2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9D5836B2A7C41D6F FOREIGN KEY (option_id) REFERENCES some_option (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO some_big_entity (id, user_id, option_id, created_at, description) SELECT id, user_id, option_id, created_at, description FROM __temp__some_big_entity');
        $this->addSql('DROP TABLE __temp__some_big_entity');
        $this->addSql('CREATE INDEX IDX_9D5836B2A7C41D6F ON some_big_entity (option_id)');
        $this->addSql('CREATE INDEX IDX_9D5836B2A76ED395 ON some_big_entity (user_id)');
        $this->addSql('DROP INDEX IDX_B506784D801740B');
        $this->addSql('DROP INDEX IDX_B5067844C37A760');
        $this->addSql('CREATE TEMPORARY TABLE __temp__some_big_entity_some_m2_mentity AS SELECT some_big_entity_id, some_m2_mentity_id FROM some_big_entity_some_m2_mentity');
        $this->addSql('DROP TABLE some_big_entity_some_m2_mentity');
        $this->addSql('CREATE TABLE some_big_entity_some_m2_mentity (some_big_entity_id INTEGER NOT NULL, some_m2_mentity_id INTEGER NOT NULL, PRIMARY KEY(some_big_entity_id, some_m2_mentity_id), CONSTRAINT FK_B5067844C37A760 FOREIGN KEY (some_big_entity_id) REFERENCES some_big_entity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B506784D801740B FOREIGN KEY (some_m2_mentity_id) REFERENCES some_m2_mentity (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO some_big_entity_some_m2_mentity (some_big_entity_id, some_m2_mentity_id) SELECT some_big_entity_id, some_m2_mentity_id FROM __temp__some_big_entity_some_m2_mentity');
        $this->addSql('DROP TABLE __temp__some_big_entity_some_m2_mentity');
        $this->addSql('CREATE INDEX IDX_B506784D801740B ON some_big_entity_some_m2_mentity (some_m2_mentity_id)');
        $this->addSql('CREATE INDEX IDX_B5067844C37A760 ON some_big_entity_some_m2_mentity (some_big_entity_id)');
        $this->addSql('DROP INDEX IDX_27552A82C54C8C93');
        $this->addSql('CREATE TEMPORARY TABLE __temp__some_option AS SELECT id, type_id, name FROM some_option');
        $this->addSql('DROP TABLE some_option');
        $this->addSql('CREATE TABLE some_option (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, CONSTRAINT FK_27552A82C54C8C93 FOREIGN KEY (type_id) REFERENCES some_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO some_option (id, type_id, name) SELECT id, type_id, name FROM __temp__some_option');
        $this->addSql('DROP TABLE __temp__some_option');
        $this->addSql('CREATE INDEX IDX_27552A82C54C8C93 ON some_option (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE image_entity');
        $this->addSql('DROP INDEX IDX_9D5836B2A76ED395');
        $this->addSql('DROP INDEX IDX_9D5836B2A7C41D6F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__some_big_entity AS SELECT id, user_id, option_id, created_at, description FROM some_big_entity');
        $this->addSql('DROP TABLE some_big_entity');
        $this->addSql('CREATE TABLE some_big_entity (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, option_id INTEGER DEFAULT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , description VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO some_big_entity (id, user_id, option_id, created_at, description) SELECT id, user_id, option_id, created_at, description FROM __temp__some_big_entity');
        $this->addSql('DROP TABLE __temp__some_big_entity');
        $this->addSql('CREATE INDEX IDX_9D5836B2A76ED395 ON some_big_entity (user_id)');
        $this->addSql('CREATE INDEX IDX_9D5836B2A7C41D6F ON some_big_entity (option_id)');
        $this->addSql('DROP INDEX IDX_B5067844C37A760');
        $this->addSql('DROP INDEX IDX_B506784D801740B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__some_big_entity_some_m2_mentity AS SELECT some_big_entity_id, some_m2_mentity_id FROM some_big_entity_some_m2_mentity');
        $this->addSql('DROP TABLE some_big_entity_some_m2_mentity');
        $this->addSql('CREATE TABLE some_big_entity_some_m2_mentity (some_big_entity_id INTEGER NOT NULL, some_m2_mentity_id INTEGER NOT NULL, PRIMARY KEY(some_big_entity_id, some_m2_mentity_id))');
        $this->addSql('INSERT INTO some_big_entity_some_m2_mentity (some_big_entity_id, some_m2_mentity_id) SELECT some_big_entity_id, some_m2_mentity_id FROM __temp__some_big_entity_some_m2_mentity');
        $this->addSql('DROP TABLE __temp__some_big_entity_some_m2_mentity');
        $this->addSql('CREATE INDEX IDX_B5067844C37A760 ON some_big_entity_some_m2_mentity (some_big_entity_id)');
        $this->addSql('CREATE INDEX IDX_B506784D801740B ON some_big_entity_some_m2_mentity (some_m2_mentity_id)');
        $this->addSql('DROP INDEX IDX_27552A82C54C8C93');
        $this->addSql('CREATE TEMPORARY TABLE __temp__some_option AS SELECT id, type_id, name FROM some_option');
        $this->addSql('DROP TABLE some_option');
        $this->addSql('CREATE TABLE some_option (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO some_option (id, type_id, name) SELECT id, type_id, name FROM __temp__some_option');
        $this->addSql('DROP TABLE __temp__some_option');
        $this->addSql('CREATE INDEX IDX_27552A82C54C8C93 ON some_option (type_id)');
    }
}
