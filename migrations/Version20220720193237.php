<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220720193237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, method_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', content LONGTEXT DEFAULT NULL, INDEX IDX_FE38F84419883967 (method_id), INDEX IDX_FE38F8449395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, trouble_id INT DEFAULT NULL, media_id INT DEFAULT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, email VARCHAR(50) DEFAULT NULL, phone VARCHAR(10) NOT NULL, street VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(5) DEFAULT NULL, town VARCHAR(50) DEFAULT NULL, birthday DATETIME NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_81398E09F9E0C452 (trouble_id), INDEX IDX_81398E09EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE method (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trouble (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F84419883967 FOREIGN KEY (method_id) REFERENCES method (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8449395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09F9E0C452 FOREIGN KEY (trouble_id) REFERENCES trouble (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
   
        $troubles = [
            'détente, massage',
            'hypersensibilité',
            'burn out'
        ];

        foreach($troubles as $trouble) {
            $this->addSql('INSERT INTO trouble (`name`) VALUES (:name)', ['name' => $trouble]);
        }

        $medias = [
            'annonce',
            'bouche à oreil',
            'site web'
        ];

        foreach($medias as $media) {
            $this->addSql('INSERT INTO media (`name`) VALUES (:name)', ['name' => $media]);
        }

        $methods = [
            'précentiel',
            'visio',
            'téléphonique'
        ];

        foreach($methods as $method) {
            $this->addSql('INSERT INTO method (`name`) VALUES (:name)', ['name' => $method]);
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8449395C3F3');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09EA9FDD75');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F84419883967');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09F9E0C452');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE method');
        $this->addSql('DROP TABLE trouble');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
