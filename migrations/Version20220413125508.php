<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220413125508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, section VARCHAR(2) NOT NULL, code VARCHAR(2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classes_course (classes_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_3AED9F429E225B24 (classes_id), INDEX IDX_3AED9F42591CC992 (course_id), PRIMARY KEY(classes_id, course_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, course_id INT NOT NULL, name VARCHAR(20) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courses (id INT AUTO_INCREMENT NOT NULL, courseid INT NOT NULL, name LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grade (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grade_course (grade_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_5431EEA7FE19A1A8 (grade_id), INDEX IDX_5431EEA7591CC992 (course_id), PRIMARY KEY(grade_id, course_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE students (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, student_id INT NOT NULL, fname VARCHAR(20) NOT NULL, lname VARCHAR(20) NOT NULL, dot DATE NOT NULL, studentid INT NOT NULL, INDEX IDX_A4698DB23256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classes_course ADD CONSTRAINT FK_3AED9F429E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classes_course ADD CONSTRAINT FK_3AED9F42591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grade_course ADD CONSTRAINT FK_5431EEA7FE19A1A8 FOREIGN KEY (grade_id) REFERENCES grade (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grade_course ADD CONSTRAINT FK_5431EEA7591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE students ADD CONSTRAINT FK_A4698DB23256915B FOREIGN KEY (relation_id) REFERENCES classes (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classes_course DROP FOREIGN KEY FK_3AED9F429E225B24');
        $this->addSql('ALTER TABLE students DROP FOREIGN KEY FK_A4698DB23256915B');
        $this->addSql('ALTER TABLE classes_course DROP FOREIGN KEY FK_3AED9F42591CC992');
        $this->addSql('ALTER TABLE grade_course DROP FOREIGN KEY FK_5431EEA7591CC992');
        $this->addSql('ALTER TABLE grade_course DROP FOREIGN KEY FK_5431EEA7FE19A1A8');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE classes_course');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE courses');
        $this->addSql('DROP TABLE grade');
        $this->addSql('DROP TABLE grade_course');
        $this->addSql('DROP TABLE students');
    }
}
