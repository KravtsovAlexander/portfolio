<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210305115334 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contacts (id VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(12) DEFAULT NULL, vk VARCHAR(45) DEFAULT NULL, telegram VARCHAR(45) DEFAULT NULL, instagram VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE genre_project (genre_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_143643164296D31F (genre_id), INDEX IDX_14364316166D1F9C (project_id), PRIMARY KEY(genre_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE label (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE label_project (label_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_933279C733B92F39 (label_id), INDEX IDX_933279C7166D1F9C (project_id), PRIMARY KEY(label_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, project_condition_id INT NOT NULL, project_type_id INT NOT NULL, title VARCHAR(45) NOT NULL, description LONGTEXT NOT NULL, google_play_link VARCHAR(255) DEFAULT NULL, app_store_link VARCHAR(255) DEFAULT NULL, web_version_link VARCHAR(255) DEFAULT NULL, INDEX IDX_2FB3D0EEA2D077D5 (project_condition_id), INDEX IDX_2FB3D0EE535280F6 (project_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_condition (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_image (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, file VARCHAR(255) NOT NULL, INDEX IDX_D6680DC1166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_type (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_video (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, file VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6F92D3B2166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text_example (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(45) NOT NULL, text LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_4A4DB4A012469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE genre_project ADD CONSTRAINT FK_143643164296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE genre_project ADD CONSTRAINT FK_14364316166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE label_project ADD CONSTRAINT FK_933279C733B92F39 FOREIGN KEY (label_id) REFERENCES label (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE label_project ADD CONSTRAINT FK_933279C7166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEA2D077D5 FOREIGN KEY (project_condition_id) REFERENCES project_condition (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE535280F6 FOREIGN KEY (project_type_id) REFERENCES project_type (id)');
        $this->addSql('ALTER TABLE project_image ADD CONSTRAINT FK_D6680DC1166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project_video ADD CONSTRAINT FK_6F92D3B2166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE text_example ADD CONSTRAINT FK_4A4DB4A012469DE2 FOREIGN KEY (category_id) REFERENCES text_category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE genre_project DROP FOREIGN KEY FK_143643164296D31F');
        $this->addSql('ALTER TABLE label_project DROP FOREIGN KEY FK_933279C733B92F39');
        $this->addSql('ALTER TABLE genre_project DROP FOREIGN KEY FK_14364316166D1F9C');
        $this->addSql('ALTER TABLE label_project DROP FOREIGN KEY FK_933279C7166D1F9C');
        $this->addSql('ALTER TABLE project_image DROP FOREIGN KEY FK_D6680DC1166D1F9C');
        $this->addSql('ALTER TABLE project_video DROP FOREIGN KEY FK_6F92D3B2166D1F9C');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEA2D077D5');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE535280F6');
        $this->addSql('ALTER TABLE text_example DROP FOREIGN KEY FK_4A4DB4A012469DE2');
        $this->addSql('DROP TABLE contacts');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE genre_project');
        $this->addSql('DROP TABLE label');
        $this->addSql('DROP TABLE label_project');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_condition');
        $this->addSql('DROP TABLE project_image');
        $this->addSql('DROP TABLE project_type');
        $this->addSql('DROP TABLE project_video');
        $this->addSql('DROP TABLE text_category');
        $this->addSql('DROP TABLE text_example');
    }
}
