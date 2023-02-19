<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214000722 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, modele_id VARCHAR(3) NOT NULL, coloris_id VARCHAR(3) NOT NULL, taille_id INT NOT NULL, ean VARCHAR(13) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_23A0E66AC14B70A (modele_id), INDEX IDX_23A0E669278BA2E (coloris_id), INDEX IDX_23A0E66FF25611A (taille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coloris (code VARCHAR(3) NOT NULL, libelle VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modele (code VARCHAR(3) NOT NULL, libelle VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pack (id INT AUTO_INCREMENT NOT NULL, ean VARCHAR(13) NOT NULL, prix DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pack_articles (id INT AUTO_INCREMENT NOT NULL, pack_id INT NOT NULL, article_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_915275791919B217 (pack_id), INDEX IDX_915275797294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (code)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E669278BA2E FOREIGN KEY (coloris_id) REFERENCES coloris (code)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('ALTER TABLE pack_articles ADD CONSTRAINT FK_915275791919B217 FOREIGN KEY (pack_id) REFERENCES pack (id)');
        $this->addSql('ALTER TABLE pack_articles ADD CONSTRAINT FK_915275797294869C FOREIGN KEY (article_id) REFERENCES article (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66AC14B70A');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E669278BA2E');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66FF25611A');
        $this->addSql('ALTER TABLE pack_articles DROP FOREIGN KEY FK_915275791919B217');
        $this->addSql('ALTER TABLE pack_articles DROP FOREIGN KEY FK_915275797294869C');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE coloris');
        $this->addSql('DROP TABLE modele');
        $this->addSql('DROP TABLE pack');
        $this->addSql('DROP TABLE pack_articles');
        $this->addSql('DROP TABLE taille');
    }
}
