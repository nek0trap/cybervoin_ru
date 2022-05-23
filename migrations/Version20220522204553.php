<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220522204553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, health INT NOT NULL, skills LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', armor LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', weapons LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', bio LONGTEXT NOT NULL, inventory LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', stats LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', wounded INT NOT NULL, deathsave INT NOT NULL, date_create_char INT NOT NULL, author INT NOT NULL, url_avatar LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, name VARCHAR(255) NOT NULL, author INT NOT NULL, characters LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', players LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', gameadmin VARCHAR(255) NOT NULL, game_board LONGTEXT NOT NULL, line_length INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_board (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, linelenght INT NOT NULL, board LONGTEXT NOT NULL, is_available TINYINT(1) DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stat_char (id INT AUTO_INCREMENT NOT NULL, stats LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weapon (id INT AUTO_INCREMENT NOT NULL, damage VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_board');
        $this->addSql('DROP TABLE stat_char');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE weapon');
    }
}
