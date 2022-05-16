<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516153458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, health INT NOT NULL, skills LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', armor LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', weapons LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', bio LONGTEXT NOT NULL, inventory LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', stats LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', wounded INT NOT NULL, deathsave INT NOT NULL, date_create_char INT NOT NULL, author INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, name VARCHAR(255) NOT NULL, author INT NOT NULL, characters LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', players LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', gameadmin INT NOT NULL, game_board INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_board (id INT AUTO_INCREMENT NOT NULL, linelenght INT NOT NULL, board VARCHAR(255) NOT NULL, is_available TINYINT(1) DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_board');
        $this->addSql('ALTER TABLE `user` CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
