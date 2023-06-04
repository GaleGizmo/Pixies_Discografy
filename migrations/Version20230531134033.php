<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230531134033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cancion (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, duracion INT DEFAULT NULL, letra LONGTEXT DEFAULT NULL, fecha_lanzamiento DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE album CHANGE canciones canciones LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', CHANGE productor productor LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cancion');
        $this->addSql('ALTER TABLE album CHANGE canciones canciones LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE productor productor LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }
}
