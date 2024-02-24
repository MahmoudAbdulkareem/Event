<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240215222634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, id_cours_id INT NOT NULL, `index` INT NOT NULL, content VARCHAR(255) NOT NULL, INDEX IDX_23A0E662E149425 (id_cours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE business (id INT NOT NULL, web_site VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE certificate (id INT AUTO_INCREMENT NOT NULL, id_course_id INT DEFAULT NULL, date DATE NOT NULL, UNIQUE INDEX UNIQ_219CDA4AD92975B5 (id_course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chat (id INT AUTO_INCREMENT NOT NULL, id_offre_id INT NOT NULL, date DATE NOT NULL, UNIQUE INDEX UNIQ_659DF2AA1C13BCCF (id_offre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, id_course_id INT DEFAULT NULL, users_id INT NOT NULL, content VARCHAR(255) NOT NULL, INDEX IDX_9474526CD92975B5 (id_course_id), INDEX IDX_9474526C67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competition (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, groupe INT NOT NULL, INDEX IDX_B50A2CB171F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE complaint (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, date DATE NOT NULL, type VARCHAR(10) NOT NULL, description VARCHAR(255) NOT NULL, status VARCHAR(20) NOT NULL, priority INT NOT NULL, INDEX IDX_5F2732B579F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, id_contract_id INT NOT NULL, type VARCHAR(40) NOT NULL, UNIQUE INDEX UNIQ_E98F28593D642D0A (id_contract_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, id_expert_id INT DEFAULT NULL, categorie VARCHAR(255) NOT NULL, rate DOUBLE PRECISION NOT NULL, state TINYINT(1) NOT NULL, description VARCHAR(255) NOT NULL, language VARCHAR(12) DEFAULT NULL, price DOUBLE PRECISION NOT NULL, discount DOUBLE PRECISION NOT NULL, INDEX IDX_169E6FB97E3C61F9 (owner_id), INDEX IDX_169E6FB9456330C3 (id_expert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, details VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expert (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE global_user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(16) NOT NULL, family_name VARCHAR(16) NOT NULL, image VARCHAR(255) DEFAULT NULL, phone_number INT DEFAULT NULL, email VARCHAR(40) NOT NULL, nationality VARCHAR(20) NOT NULL, language VARCHAR(20) NOT NULL, reputation INT NOT NULL, description VARCHAR(255) DEFAULT NULL, Role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE global_user_chat (global_user_id INT NOT NULL, chat_id INT NOT NULL, INDEX IDX_C31DD5FACCEA1374 (global_user_id), INDEX IDX_C31DD5FA1A9A7125 (chat_id), PRIMARY KEY(global_user_id, chat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_competition (id INT AUTO_INCREMENT NOT NULL, competition_id INT NOT NULL, name VARCHAR(20) NOT NULL, INDEX IDX_90B233707B39D312 (competition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_competition_normal_user (group_competition_id INT NOT NULL, normal_user_id INT NOT NULL, INDEX IDX_13F8D304E3B41A60 (group_competition_id), INDEX IDX_13F8D304DE39982E (normal_user_id), PRIMARY KEY(group_competition_id, normal_user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, id_chat_room_id INT NOT NULL, id_sender_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_B6BD307F3BD8C988 (id_chat_room_id), INDEX IDX_B6BD307F76110FBA (id_sender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE normal_user (id INT NOT NULL, cv VARCHAR(255) DEFAULT NULL, experience_level VARCHAR(255) DEFAULT NULL, score DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE normal_user_course (normal_user_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_1953DD35DE39982E (normal_user_id), INDEX IDX_1953DD35591CC992 (course_id), PRIMARY KEY(normal_user_id, course_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE normal_user_road_map (normal_user_id INT NOT NULL, road_map_id INT NOT NULL, INDEX IDX_14681E8DDE39982E (normal_user_id), INDEX IDX_14681E8DC506591C (road_map_id), PRIMARY KEY(normal_user_id, road_map_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE normal_user_event (normal_user_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_F6E5B2EEDE39982E (normal_user_id), INDEX IDX_F6E5B2EE71F7E88B (event_id), PRIMARY KEY(normal_user_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE normal_user_certificate (normal_user_id INT NOT NULL, certificate_id INT NOT NULL, INDEX IDX_FC1E1814DE39982E (normal_user_id), INDEX IDX_FC1E181499223FFD (certificate_id), PRIMARY KEY(normal_user_id, certificate_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, id_category_id INT NOT NULL, id_creator_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, type_offre VARCHAR(255) NOT NULL, experience_level INT NOT NULL, salary DOUBLE PRECISION NOT NULL, expiration_date DATE NOT NULL, description VARCHAR(255) NOT NULL, language VARCHAR(255) NOT NULL, priority INT NOT NULL, INDEX IDX_AF86866FA545015 (id_category_id), INDEX IDX_AF86866FC4A88E71 (id_creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_global_user (offre_id INT NOT NULL, global_user_id INT NOT NULL, INDEX IDX_C7ED6C054CC8505A (offre_id), INDEX IDX_C7ED6C05CCEA1374 (global_user_id), PRIMARY KEY(offre_id, global_user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE response (id INT AUTO_INCREMENT NOT NULL, id_complaint_id INT NOT NULL, date DATE NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_3E7B0BFBCE6F6DFC (id_complaint_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE road_map (id INT AUTO_INCREMENT NOT NULL, rate DOUBLE PRECISION NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE road_map_course (road_map_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_1A7F2B8C506591C (road_map_id), INDEX IDX_1A7F2B8591CC992 (course_id), PRIMARY KEY(road_map_id, course_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, id_course_id INT DEFAULT NULL, `index` INT NOT NULL, duration INT NOT NULL, data VARCHAR(255) NOT NULL, INDEX IDX_7CC7DA2CD92975B5 (id_course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES global_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E662E149425 FOREIGN KEY (id_cours_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE business ADD CONSTRAINT FK_8D36E38BF396750 FOREIGN KEY (id) REFERENCES global_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE certificate ADD CONSTRAINT FK_219CDA4AD92975B5 FOREIGN KEY (id_course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA1C13BCCF FOREIGN KEY (id_offre_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CD92975B5 FOREIGN KEY (id_course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C67B3B43D FOREIGN KEY (users_id) REFERENCES global_user (id)');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB171F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE complaint ADD CONSTRAINT FK_5F2732B579F37AE5 FOREIGN KEY (id_user_id) REFERENCES global_user (id)');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F28593D642D0A FOREIGN KEY (id_contract_id) REFERENCES offre (id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB97E3C61F9 FOREIGN KEY (owner_id) REFERENCES normal_user (id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9456330C3 FOREIGN KEY (id_expert_id) REFERENCES expert (id)');
        $this->addSql('ALTER TABLE expert ADD CONSTRAINT FK_4F1B9342BF396750 FOREIGN KEY (id) REFERENCES global_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE global_user_chat ADD CONSTRAINT FK_C31DD5FACCEA1374 FOREIGN KEY (global_user_id) REFERENCES global_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE global_user_chat ADD CONSTRAINT FK_C31DD5FA1A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_competition ADD CONSTRAINT FK_90B233707B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id)');
        $this->addSql('ALTER TABLE group_competition_normal_user ADD CONSTRAINT FK_13F8D304E3B41A60 FOREIGN KEY (group_competition_id) REFERENCES group_competition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_competition_normal_user ADD CONSTRAINT FK_13F8D304DE39982E FOREIGN KEY (normal_user_id) REFERENCES normal_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F3BD8C988 FOREIGN KEY (id_chat_room_id) REFERENCES chat (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F76110FBA FOREIGN KEY (id_sender_id) REFERENCES global_user (id)');
        $this->addSql('ALTER TABLE normal_user ADD CONSTRAINT FK_9811D429BF396750 FOREIGN KEY (id) REFERENCES global_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE normal_user_course ADD CONSTRAINT FK_1953DD35DE39982E FOREIGN KEY (normal_user_id) REFERENCES normal_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE normal_user_course ADD CONSTRAINT FK_1953DD35591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE normal_user_road_map ADD CONSTRAINT FK_14681E8DDE39982E FOREIGN KEY (normal_user_id) REFERENCES normal_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE normal_user_road_map ADD CONSTRAINT FK_14681E8DC506591C FOREIGN KEY (road_map_id) REFERENCES road_map (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE normal_user_event ADD CONSTRAINT FK_F6E5B2EEDE39982E FOREIGN KEY (normal_user_id) REFERENCES normal_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE normal_user_event ADD CONSTRAINT FK_F6E5B2EE71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE normal_user_certificate ADD CONSTRAINT FK_FC1E1814DE39982E FOREIGN KEY (normal_user_id) REFERENCES normal_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE normal_user_certificate ADD CONSTRAINT FK_FC1E181499223FFD FOREIGN KEY (certificate_id) REFERENCES certificate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FA545015 FOREIGN KEY (id_category_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FC4A88E71 FOREIGN KEY (id_creator_id) REFERENCES global_user (id)');
        $this->addSql('ALTER TABLE offre_global_user ADD CONSTRAINT FK_C7ED6C054CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_global_user ADD CONSTRAINT FK_C7ED6C05CCEA1374 FOREIGN KEY (global_user_id) REFERENCES global_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFBCE6F6DFC FOREIGN KEY (id_complaint_id) REFERENCES complaint (id)');
        $this->addSql('ALTER TABLE road_map_course ADD CONSTRAINT FK_1A7F2B8C506591C FOREIGN KEY (road_map_id) REFERENCES road_map (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE road_map_course ADD CONSTRAINT FK_1A7F2B8591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CD92975B5 FOREIGN KEY (id_course_id) REFERENCES course (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D76BF396750');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E662E149425');
        $this->addSql('ALTER TABLE business DROP FOREIGN KEY FK_8D36E38BF396750');
        $this->addSql('ALTER TABLE certificate DROP FOREIGN KEY FK_219CDA4AD92975B5');
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AA1C13BCCF');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CD92975B5');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C67B3B43D');
        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB171F7E88B');
        $this->addSql('ALTER TABLE complaint DROP FOREIGN KEY FK_5F2732B579F37AE5');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F28593D642D0A');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB97E3C61F9');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB9456330C3');
        $this->addSql('ALTER TABLE expert DROP FOREIGN KEY FK_4F1B9342BF396750');
        $this->addSql('ALTER TABLE global_user_chat DROP FOREIGN KEY FK_C31DD5FACCEA1374');
        $this->addSql('ALTER TABLE global_user_chat DROP FOREIGN KEY FK_C31DD5FA1A9A7125');
        $this->addSql('ALTER TABLE group_competition DROP FOREIGN KEY FK_90B233707B39D312');
        $this->addSql('ALTER TABLE group_competition_normal_user DROP FOREIGN KEY FK_13F8D304E3B41A60');
        $this->addSql('ALTER TABLE group_competition_normal_user DROP FOREIGN KEY FK_13F8D304DE39982E');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F3BD8C988');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F76110FBA');
        $this->addSql('ALTER TABLE normal_user DROP FOREIGN KEY FK_9811D429BF396750');
        $this->addSql('ALTER TABLE normal_user_course DROP FOREIGN KEY FK_1953DD35DE39982E');
        $this->addSql('ALTER TABLE normal_user_course DROP FOREIGN KEY FK_1953DD35591CC992');
        $this->addSql('ALTER TABLE normal_user_road_map DROP FOREIGN KEY FK_14681E8DDE39982E');
        $this->addSql('ALTER TABLE normal_user_road_map DROP FOREIGN KEY FK_14681E8DC506591C');
        $this->addSql('ALTER TABLE normal_user_event DROP FOREIGN KEY FK_F6E5B2EEDE39982E');
        $this->addSql('ALTER TABLE normal_user_event DROP FOREIGN KEY FK_F6E5B2EE71F7E88B');
        $this->addSql('ALTER TABLE normal_user_certificate DROP FOREIGN KEY FK_FC1E1814DE39982E');
        $this->addSql('ALTER TABLE normal_user_certificate DROP FOREIGN KEY FK_FC1E181499223FFD');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866FA545015');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866FC4A88E71');
        $this->addSql('ALTER TABLE offre_global_user DROP FOREIGN KEY FK_C7ED6C054CC8505A');
        $this->addSql('ALTER TABLE offre_global_user DROP FOREIGN KEY FK_C7ED6C05CCEA1374');
        $this->addSql('ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFBCE6F6DFC');
        $this->addSql('ALTER TABLE road_map_course DROP FOREIGN KEY FK_1A7F2B8C506591C');
        $this->addSql('ALTER TABLE road_map_course DROP FOREIGN KEY FK_1A7F2B8591CC992');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CD92975B5');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE business');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE certificate');
        $this->addSql('DROP TABLE chat');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE complaint');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE expert');
        $this->addSql('DROP TABLE global_user');
        $this->addSql('DROP TABLE global_user_chat');
        $this->addSql('DROP TABLE group_competition');
        $this->addSql('DROP TABLE group_competition_normal_user');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE normal_user');
        $this->addSql('DROP TABLE normal_user_course');
        $this->addSql('DROP TABLE normal_user_road_map');
        $this->addSql('DROP TABLE normal_user_event');
        $this->addSql('DROP TABLE normal_user_certificate');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE offre_global_user');
        $this->addSql('DROP TABLE response');
        $this->addSql('DROP TABLE road_map');
        $this->addSql('DROP TABLE road_map_course');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
