<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515102911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category_name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_64C19C1989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE channel (id INT AUTO_INCREMENT NOT NULL, channel_name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_A2F98E47989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE channel_used (id INT AUTO_INCREMENT NOT NULL, room_id INT DEFAULT NULL, channel_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_E513C06654177093 (room_id), INDEX IDX_E513C06672F5A1AA (channel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guest (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, member_since DATE NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, hotel_name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_3535ED912469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_guest (id INT AUTO_INCREMENT NOT NULL, guest_id INT DEFAULT NULL, reservation_id INT DEFAULT NULL, invoice_amount DOUBLE PRECISION NOT NULL, issued_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', paid_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', canceled_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_916DCA809A4AA658 (guest_id), INDEX IDX_916DCA80B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, guest_id INT DEFAULT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, discount_percent DOUBLE PRECISION DEFAULT NULL, total_price DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_42C849559A4AA658 (guest_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_status_catalog (id INT AUTO_INCREMENT NOT NULL, status_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_status_event (id INT AUTO_INCREMENT NOT NULL, reservation_id INT DEFAULT NULL, reservation_status_catalog_id INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_AEE52A55B83297E7 (reservation_id), INDEX IDX_AEE52A552E03D681 (reservation_status_catalog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, hotel_id INT DEFAULT NULL, room_type_id INT DEFAULT NULL, room_name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, current_price INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_729F519B3243BB18 (hotel_id), INDEX IDX_729F519B296E3073 (room_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_reserved (id INT AUTO_INCREMENT NOT NULL, reservation_id INT DEFAULT NULL, room_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_ED442B06B83297E7 (reservation_id), INDEX IDX_ED442B0654177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room_type (id INT AUTO_INCREMENT NOT NULL, type_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE synchronization (id INT AUTO_INCREMENT NOT NULL, reservation_id INT DEFAULT NULL, channel_id INT DEFAULT NULL, message_sent LONGTEXT DEFAULT NULL, message_received LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_8AF3CC3AB83297E7 (reservation_id), INDEX IDX_8AF3CC3A72F5A1AA (channel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE channel_used ADD CONSTRAINT FK_E513C06654177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE channel_used ADD CONSTRAINT FK_E513C06672F5A1AA FOREIGN KEY (channel_id) REFERENCES channel (id)');
        $this->addSql('ALTER TABLE hotel ADD CONSTRAINT FK_3535ED912469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE invoice_guest ADD CONSTRAINT FK_916DCA809A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id)');
        $this->addSql('ALTER TABLE invoice_guest ADD CONSTRAINT FK_916DCA80B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559A4AA658 FOREIGN KEY (guest_id) REFERENCES guest (id)');
        $this->addSql('ALTER TABLE reservation_status_event ADD CONSTRAINT FK_AEE52A55B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE reservation_status_event ADD CONSTRAINT FK_AEE52A552E03D681 FOREIGN KEY (reservation_status_catalog_id) REFERENCES reservation_status_catalog (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B3243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B296E3073 FOREIGN KEY (room_type_id) REFERENCES room_type (id)');
        $this->addSql('ALTER TABLE room_reserved ADD CONSTRAINT FK_ED442B06B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE room_reserved ADD CONSTRAINT FK_ED442B0654177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE synchronization ADD CONSTRAINT FK_8AF3CC3AB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE synchronization ADD CONSTRAINT FK_8AF3CC3A72F5A1AA FOREIGN KEY (channel_id) REFERENCES channel (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE channel_used DROP FOREIGN KEY FK_E513C06654177093');
        $this->addSql('ALTER TABLE channel_used DROP FOREIGN KEY FK_E513C06672F5A1AA');
        $this->addSql('ALTER TABLE hotel DROP FOREIGN KEY FK_3535ED912469DE2');
        $this->addSql('ALTER TABLE invoice_guest DROP FOREIGN KEY FK_916DCA809A4AA658');
        $this->addSql('ALTER TABLE invoice_guest DROP FOREIGN KEY FK_916DCA80B83297E7');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559A4AA658');
        $this->addSql('ALTER TABLE reservation_status_event DROP FOREIGN KEY FK_AEE52A55B83297E7');
        $this->addSql('ALTER TABLE reservation_status_event DROP FOREIGN KEY FK_AEE52A552E03D681');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B3243BB18');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B296E3073');
        $this->addSql('ALTER TABLE room_reserved DROP FOREIGN KEY FK_ED442B06B83297E7');
        $this->addSql('ALTER TABLE room_reserved DROP FOREIGN KEY FK_ED442B0654177093');
        $this->addSql('ALTER TABLE synchronization DROP FOREIGN KEY FK_8AF3CC3AB83297E7');
        $this->addSql('ALTER TABLE synchronization DROP FOREIGN KEY FK_8AF3CC3A72F5A1AA');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE channel');
        $this->addSql('DROP TABLE channel_used');
        $this->addSql('DROP TABLE guest');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE invoice_guest');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_status_catalog');
        $this->addSql('DROP TABLE reservation_status_event');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE room_reserved');
        $this->addSql('DROP TABLE room_type');
        $this->addSql('DROP TABLE synchronization');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
